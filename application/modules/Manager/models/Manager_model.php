<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_model extends CI_Model {

    public function get_facilities_level_distribution($filters) {
        $this->db->select("Level name,COUNT(*)y, UPPER(Level) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        return $this->get_facilities_level_distribution_drilldown(array('main' => $query->result_array()), $filters);
    }

    public function get_facilities_level_distribution_drilldown($main_data, $filters) {
        $drilldown_data = array();
        $this->db->select("UPPER(Level) category, County name,COUNT(*)y, UPPER(County) drilldown", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('drilldown');
        $this->db->order_by('y', 'Desc');
        $query = $this->db->get('tbl_facility_details');
        $sub_data = $query->result_array();

        if ($main_data) {
            foreach ($main_data['main'] as $counter => $main) {
                $category = $main['drilldown'];

                $drilldown_data['drilldown'][$counter]['id'] = $category;
                $drilldown_data['drilldown'][$counter]['name'] = ucwords($category);
                $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                foreach ($sub_data as $sub) {
                    if ($category == $sub['category']) {
                        unset($sub['category']);
                        $drilldown_data['drilldown'][$counter]['data'][] = $sub;
                    }
                }
            }
        }
        $drilldown_data = $this->get_distribution_drilldown_level2($drilldown_data, $filters);
        return array_merge($main_data, $drilldown_data);
    }

    public function get_distribution_drilldown_level2($drilldown_data, $filters) {
        $this->db->select("UPPER(County) category, Sub_County name,COUNT(*)y", FALSE);
        if (!empty($filters)) {
            foreach ($filters as $category => $filter) {
                $this->db->where_in($category, $filter);
            }
        }
        $this->db->group_by('name');
        $this->db->order_by('y', 'DESC');
        $query = $this->db->get('tbl_facility_details');
        $population_data = $query->result_array();

        if ($drilldown_data) {
            $counter = sizeof($drilldown_data['drilldown']);
            foreach ($drilldown_data['drilldown'] as $main_data) {
                if (!empty($main_data['data'])) {
                    foreach ($main_data['data'] as $item) {
                        $filter_value = $item['name'];
                        $filter_name = $item['drilldown'];

                        $drilldown_data['drilldown'][$counter]['id'] = $filter_name;
                        $drilldown_data['drilldown'][$counter]['name'] = ucwords($filter_name);
                        $drilldown_data['drilldown'][$counter]['colorByPoint'] = true;

                        foreach ($population_data as $population) {
                            if ($filter_name == $population['category']) {
                                unset($population['category']);
                                $drilldown_data['drilldown'][$counter]['data'][] = $population;
                            }
                        }
                        $counter += 1;
                    }
                }
            }
        }
        return $drilldown_data;
    }

}
