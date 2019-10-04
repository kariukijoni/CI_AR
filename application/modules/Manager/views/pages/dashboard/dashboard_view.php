<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
            <?php echo $this->session->flashdata('dashboard_msg'); ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> 
                            Facility Level Distribution
                            <span class="label label-warning">Drilldown</span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="facilities_level_distribution_chart"></div>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<script>
    var chartURL = '../Manager/get_chart'
    var filters = {}
    $(document).ready(function () {
        var charts = ['facilities_level_distribution_chart']

        //Add filter to chart then load chart
        setChartFilter('facilities_level_distribution_chart')

        //Load Charts
        $.each(charts, function(key, chartName) {
            LoadChart('#'+chartName, chartURL, chartName, {})
        });

        //Show dashboard sidemenu
        $(".dashboard").closest('ul').addClass("in");
        $(".dashboard").addClass("active active-page");

        //Filter click Event
        $(".filter_btn").on("click", FilterBtnHandler);

        //Clear click Event
        $(".clear_btn").on("click", ClearBtnHandler);
    });

    function setChartFilter(chartName, filterURL){
        $.ajax({
            url: filterURL,
            datatype: 'JSON',
            success: function(data){
                filterID = '#'+chartName+'_filter'
                //Create multiselect box
                CreateSelectBox(filterID, '100%', 10)
                //Add data to selectbox
                $(filterID+ " option").remove();
                $.each(data, function(i, v) {
                    $(filterID).append($("<option value='" + v.name + "'>" + v.name.toUpperCase() + "</option>"));
                });
                $(filterID).multiselect('rebuild');
                $(filterID).data('filter_type', 'drug');
            },
            complete: function(){
                LoadChart('#'+chartName, chartURL, chartName, {})
            }
        });
    }

    function CreateSelectBox(elementID, width, limit){
        $(elementID).val('').multiselect({
            enableCaseInsensitiveFiltering: true,
            enableFiltering: true,
            disableIfEmpty: true,
            maxHeight: 300,
            buttonWidth: width,
            nonSelectedText: 'None selected',
            includeSelectAllOption: false,
            selectAll: false, 
            onChange: function(option, checked) {
                //Get selected options.
                var selectedOptions = $(elementID + ' option:selected');
                if (selectedOptions.length >= limit) {
                    //Disable all other checkboxes.
                    var nonSelectedOptions = $(elementID + ' option').filter(function() {
                        return !$(this).is(':selected');
                    });
                    nonSelectedOptions.each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', true);
                        input.parent('li').addClass('disabled');
                    });
                }
                else {
                    //Enable all checkboxes.
                    $(elementID + ' option').each(function() {
                        var input = $('input[value="' + $(this).val() + '"]');
                        input.prop('disabled', false);
                        input.parent('li').addClass('disabled');
                    });
                }
            }
        });
    }

    function LoadSpinner(divID){
        var spinner = new Spinner().spin()
        $(divID).empty('')
        $(divID).height('auto')
        $(divID).append(spinner.el)
    }

    function LoadChart(divID, chartURL, chartName, selectedfilters){
        //Load Spinner
        LoadSpinner(divID)
        //Load Chart*
        $(divID).load(chartURL, {'name':chartName, 'selectedfilters': selectedfilters}, function(){
            //Pre-select filters for charts
            $.each($(divID + '_filters').data('filters'), function(key, data){
                if($.inArray(key, ['data_year', 'data_month', 'data_date', 'county', 'subcounty']) == -1){
                    $(divID + "_filter").val(data).multiselect('refresh');
                    //Output filters
                    var filtermsg = '<b><u>'+key.toUpperCase()+':</u></b><br/>'
                    if($.isArray(data)){
                        filtermsg += data.join('<br/>')
                    }else{
                        filtermsg += data
                    }
                    $("."+chartName+"_heading").html(filtermsg) 
                }
            });
        });
    }

    function FilterBtnHandler(e){
        var filterName = String($(e.target).attr("id")).replace('_btn', '')
        var filterID = "#"+filterName
        var filterType = $(filterID).data('filter_type')
        var chartName = filterName.replace('_filter', '')
        var chartID = "#"+chartName


        if($(filterID).val() != null){
            filters[filterType] = $(filterID).val()
        }

        LoadChart(chartID, chartURL, chartName, filters)

        //Hide Modal
        $(filterID+'_modal').modal('hide')
    }

    function ClearBtnHandler(e){
        var filterName = String($(e.target).attr("id")).replace('_clear_btn', '')
        var filterID = "#"+filterName
        var filterType = $(filterID).data('filter_type')

        //Clear filterType
        filters[filterType] = {}

        //Filter multiple multiselect
        $(filterID).multiselect('deselectAll', false);
        $(filterID).multiselect('updateButtonText');
        $(filterID).multiselect('refresh');
        
        //Trigger filter event
        $(filterID+'_btn').trigger('click');
    }
</script>