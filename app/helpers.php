<?php
use App\Common\Utils;
// use App\Models\Category;


/* Get all categories */
function get_category_treeview()
{
    $search_params = array('status'=>1, 'deleted_at'=>NULL);
    $category_list = Utils::getCategoryTreeArray($search_params);

    return $category_list;
}
