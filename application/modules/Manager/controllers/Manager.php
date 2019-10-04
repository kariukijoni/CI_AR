<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MX_Controller {

    public function index() {
        $this->load_page('user', 'login', 'Login');
    }

    public function load_page($module = 'user', $page = 'login', $title = 'Login') {
        if ($page == 'register') {
            $this->db->where_not_in('name', 'admin');
            $data['roles'] = $this->db->get('tbl_role')->result_array();
        }
        $data['page_title'] = 'ABS | ' . $title;
        $this->load->view('pages/' . $module . '/' . $page . '_view', $data);
    }

    public function load_template($module = 'dashboard', $page = 'dashboard', $title = 'Dashboard', $is_table = TRUE) {
        if ($this->session->userdata('id')) {
            $data['page_name'] = $page;
            $data['content_view'] = 'pages/' . $module . '/' . $page . '_view';
            if ($is_table) {
                $data['columns'] = $this->db->list_fields('tbl_' . $page);
                $data['content_view'] = 'template/table_view';
            }

            $data['page_title'] = 'ABS | ' . ucwords($title);
            $this->load->view('template/template_view', $data);
        } else {
            redirect("manager/login");
        }
    }

    public function get_chart() {
        $chartname = $this->input->post('name');
        $selectedfilters = $this->get_filter($chartname, $this->input->post('selectedfilters'));
        //Set filters based on role and scope
        $role = $this->session->userdata('role');
        if (!in_array($role, array('admin', 'national'))) {
            $selectedfilters[$role] = $this->session->userdata('scope_name');
        }
        //Get chart configuration
        $data['chart_name'] = $chartname;
        $data['chart_title'] = $this->config->item($chartname . '_title');
        $data['chart_yaxis_title'] = $this->config->item($chartname . '_yaxis_title');
        $data['chart_xaxis_title'] = $this->config->item($chartname . '_xaxis_title');
        $data['chart_source'] = $this->config->item($chartname . '_source');
        //Get data
        $main_data = array('main' => array(), 'drilldown' => array(), 'columns' => array());
        $main_data = $this->get_data($chartname, $selectedfilters);
        if ($this->config->item($chartname . '_has_drilldown')) {
            $data['chart_drilldown_data'] = json_encode(@$main_data['drilldown'], JSON_NUMERIC_CHECK);
        } else {
            $data['chart_categories'] = json_encode(@$main_data['columns'], JSON_NUMERIC_CHECK);
        }
        $data['selectedfilters'] = htmlspecialchars(json_encode($selectedfilters), ENT_QUOTES, 'UTF-8');
        $data['chart_series_data'] = json_encode($main_data['main'], JSON_NUMERIC_CHECK);
        //Load chart
        $this->load->view($this->config->item($chartname . '_chartview'), $data);
    }

    public function get_filter($chartname, $selectedfilters) {
        $filters = $this->config->item($chartname . '_filters_default');
        $filtersColumns = $this->config->item($chartname . '_filters');

        if (!empty($selectedfilters)) {
            foreach (array_keys($selectedfilters) as $filter) {
                if (in_array($filter, $filtersColumns)) {
                    $filters[$filter] = $selectedfilters[$filter];
                }
            }
        }
        return $filters;
    }

    public function get_data($chartname, $filters) {
        if ($chartname == 'facilities_level_distribution_chart') {
            $main_data = $this->manager_model->get_facilities_level_distribution($filters);
        }
        return $main_data;
    }
   

}
