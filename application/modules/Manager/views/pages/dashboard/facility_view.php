<div id="page-wrapper">
    <div class="container-fluid">
        <br/>
        <button class="btn btn-default btn-sm" onclick="add_facility()"><i class="glyphicon glyphicon-plus"></i> Add facility</button>
        <br />
        <br />
        <table id="table" class="table table-condensed table-hover table-bordered table-responsive" width="100%">
            <thead>
                <tr>
                    <th>Facility</th>
                    <th>Sub County</th>
                    <th>Level</th>
                    <th>Owner</th>
                    <th>Focal Person</th>
                    <th>Partner Support</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">

        var subcountyURL = '../API/subcounty';
        //subcounties
        $.getJSON(subcountyURL, function (data) {
            $("#subcounty option").remove();
            $("#subcounty").append($("<option value=''>Select Subcounty</option>"));
            $.each(data, function (i, v) {
                $("#subcounty").append($("<option value='" + v.id + "' countyid='" + v.county_id + "'>" + v.name + "</option>"));
            });
        });
        var save_method;
        var table;
        $(document).ready(function () {
            table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('manager/facility_list') ?>",
                    "type": "POST"
                },
                "columnDefs": [
                    {
                        "targets": [-1], //last column
                        "orderable": false,
                    },
                ],
            });

            $("input").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("textarea").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });
            $("select").change(function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
            });

        });
        function add_facility()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add facility');
        }

        function edit_facility(id)
        {
            save_method = 'update';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();

            $.ajax({
                url: "<?php echo base_url('Manager/Facility/facility_edit/') ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data)
                {

                    $('[name="ID"]').val(data.ID);
                    $('[name="facility"]').val(data.facility);
                    $('[name="Sub_County"]').val(data.Sub_County);
                    $('[name="Level"]').val(data.Level);
                    $('[name="Owner"]').val(data.Owner);
                    $('[name="Focal_Person"]').val(data.Focal_Person);
                    $('[name="Partner_Support"]').val(data.Partner_Support);
                    $('[name="Latitude"]').val(data.Latitude);
                    $('[name="Longitude"]').val(data.Longitude);

                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit facility');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data');
                }
            });
        }

        function reload_table()
        {
            table.ajax.reload(null, false);
        }

        function save()
        {
            $('#btnSave').text('saving...');
            $('#btnSave').attr('disabled', true);
            var url;

            if (save_method == 'add') {
                url = "<?php echo base_url('Manager/Facility/facility_add') ?>";
            } else {
                url = "<?php echo base_url('Manager/Facility/facility_update') ?>";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    if (data.status)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    } else
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled', false);

                }
            });
        }

        function delete_facility(id)
        {
            if (confirm('Are you sure delete this data?'))
            {
                $.ajax({
                    url: "<?php echo base_url('Manager/Facility/facility_delete') ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data)
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });

            }
        }
    </script>

    <!-- Add/Edit modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Person Form</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" value="" name="ID"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Facility</label>
                                <div class="col-md-9">
                                    <input name="facility" placeholder="Facility" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Sub County</label>
                                <div class="col-md-9">
                                    <select name="Sub_County" id="subcounty" class="form-control" type="text"></select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Level</label>
                                <div class="col-md-9">
                                    <select name="Level" class="form-control">
                                        <option value="">Select Level</option>
                                        <option value="County Hospital">County Hospital</option>
                                        <option value="County Referral Hospital">County Referral Hospital</option>
                                        <option value="DICE">DICE</option>
                                        <option value="Dispensary">Dispensary</option>                                       
                                        <option value="Health Center">Health Center</option>
                                        <option value="National Referral Hospital">National Referral Hospital</option>
                                        <option value="Other (specify)">Other (specify)</option>
                                        <option value="Sub County Hospital">Sub County Hospital</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Owner</label>
                                <div class="col-md-9">
                                    <select name="Owner" class="form-control">
                                        <option value="">Select Owner</option>
                                        <option value="FBO">FBO</option>
                                        <option value="GOVERNMENT (PUBLIC)">GOVERNMENT (PUBLIC)</option>
                                        <option value="NGO">NGO</option>
                                        <option value="PRIVATE">PRIVATE</option>
                                        <option value="Other (specify)">Other (specify)</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Focal Person</label>
                                <div class="col-md-9">
                                    <select name="Focal_Person" class="form-control">
                                        <option value="">Select Focal Person</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Partner Support</label>
                                <div class="col-md-9">
                                    <select name="Partner_Support" class="form-control">
                                        <option value="">Select Partner Support</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Latitude</label>
                                <div class="col-md-9">
                                    <input name="Latitude" placeholder="Latitude" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Longitude</label>
                                <div class="col-md-9">
                                    <input name="Longitude" placeholder="Longitude" class="form-control" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</div>