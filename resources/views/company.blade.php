<!DOCTYPE html>
<html>
<head>
    <title>Company CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

<div class="container">
    <h1 class="text-center">Company CRUD</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewCompany">
        <i class="bi bi-bookmark-plus"></i> Create New Company
    </a>
<hr>
    <table class="table table-bordered data-table mt-8">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Owner First Name</th>
            <th>Owner Last Name</th>
            <th>Groups</th>
            <th width="150px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="companyForm" name="companyForm" class="form-horizontal">
                    <input type="hidden" name="company_id" id="company_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Company Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Enter Name of the Company"
                                   value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="companyGroups" class="col-sm-6 control-label">Company Groups</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="groupSelect" name="groups[]" data-width="100%" multiple="multiple">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="col-sm-12 control-label">Owner First Name</label>
                            <div class="col-sm-12 pr-0">
                                <input type="text" id="ownerFirstName" name="owner_first_name" required="" placeholder="Enter Owner First Name" class="form-control"></input>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label class="col-sm-12 control-label">Owner Last Name</label>
                            <div class="col-sm-12 pl-0">
                                <input type="text" id="ownerLastName" name="owner_last_name" required="" placeholder="Enter Owner Last Name" class="form-control"></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Phone Number</label>
                        <div class="col-sm-12">
                            <input type="text" id="phone" name="phone" required="" placeholder="Enter Phone" class="form-control"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Addres</label>
                        <div class="col-sm-12">
                            <textarea id="address" name="address" required="" placeholder="Address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="col-sm-6 control-label">City</label>
                            <div class="col-sm-12 pr-0">
                                <input type="text" id="city" name="city" required="" placeholder="Enter City" class="form-control"></input>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label class="col-sm-6 control-label">Country</label>
                            <div class="col-sm-12 pl-0">
                                <input type="text" id="country" name="country" required="" placeholder="Enter Country" class="form-control"></input>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#groupSelect").select2({
            tags: true,
            allowClear: true,
            placeholder: "Select a groups",
        }).on('change', function (e) {
            var data = $(this).select2('data');
            var lastSelected = data[data.length - 1];

            // Check if it's a new group
            if (lastSelected && lastSelected.id === lastSelected.text) {

                var newGroupName = lastSelected.text;
                console.log(newGroupName);

                // Create a new group with the entered name
                $.ajax({
                    method: 'POST',
                    url: '{{ route("groups.store") }}',
                    data: {
                        name: newGroupName
                    },
                    success: function (response) {
                        var newGroupId = response.id;
                        var newOptionExists = $('#groupSelect').find('option').filter(function () {
                            return $(this).text() === newGroupName;
                        }).length > 0;
                        if (newOptionExists) {
                            $('#groupSelect option').filter(function () {
                                return $(this).text() === newGroupName;
                            }).val(newGroupId).trigger('change');
                            console.log('Existing group updated with new ID');
                        }
                    },
                    error: function (error) {
                        console.error('Error creating new group:', error);
                    }
                });
            }
        });

        /* Pass Header Token */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* Render DataTable */
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('companies.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'owner_first_name', name: 'owner_first_name'},
                {data: 'owner_last_name', name:'owner_last_name'},
                {data: 'groups', name:'groups'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        /* Click to Create company */
        $('#createNewCompany').click(function () {
            $('#saveBtn').val("create-company");
            $('#id').val('');
            $('#groupSelect').val(null).trigger('change');
            $('#companyForm').trigger("reset");
            $('#modelHeading').html("Create New Company");
            $('#ajaxModel').modal('show');
        });

        /* Click to Edit Company */
        $('body').on('click', '.editCompany', function () {
            var company_id = $(this).data('id');
            $.get("{{ route('companies.index') }}" +'/' + company_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Company");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#company_id').val(data.id);
                $('#name').val(data.name);
                $('#ownerFirstName').val(data.owner_first_name);
                $('#ownerLastName').val(data.owner_last_name);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#country').val(data.country);

                // Get all groups for the Select2 dropdown
                var groups = {!! json_encode($groups) !!};

                // Pre-select the groups connected to the company
                var selectedGroups = data.groups.map(group => group.id);
                $('#groupSelect').val(selectedGroups);
                $('#groupSelect').trigger('change');
            })
        });

        /* Create Company */
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            var selectedGroups = $('#groupSelect').val();

            console.log(selectedGroups);
            var formData = $('#companyForm').serializeArray();
            formData.push({name: 'groups', value: selectedGroups});

            $.ajax({
                data: formData,
                url: "{{ route('companies.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        /* Delete Company */
        $('body').on('click', '.deleteCompany', function () {

            var company_id = $(this).data("id");
            confirm("Are You sure want to delete this company?");

            $.ajax({
                type: "DELETE",
                url: "{{ route('companies.store') }}"+'/' + company_id,
                success: function (data) {
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });

</script>

</body>


</html>
