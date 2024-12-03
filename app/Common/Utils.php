<?php

namespace App\Common;

use Illuminate\Support\Facades\DB;
use Redirect;
use Config;

// Models
use App\Models\User;
use Carbon\Carbon;
use Session;

use App\Models\Category;

class Utils
{  

    /* ************************************************************* */
    /* ****** Generate tree view structure uo to nth level ********  */
    /* ************************************************************* */
    public static function buildTree($items, $parentId = 0)
    {
        $treeArray = [];
        foreach ($items as $item) {
            if ($item["parent_id"] == $parentId) {
                $children = self::buildTree($items, $item["id"]);
                if ($children) {
                    $item["children"] = $children;
                }
                $treeArray[] = $item;
            }
        }

        return $treeArray;
    }

    /* ************************************************************* */
    /* ************************************************************* */

    public static function getCategoryTreeArray($search_params=array())
    {  
        $treeArray = [];
        $formattedMenuList = Category::getFormattedCategory($search_params); 
        $formattedMenuListArr = json_decode( json_encode($formattedMenuList), true ); //convert object to array
        $treeArray = self::buildTree($formattedMenuListArr);

        return $treeArray;
    }

    // Helper function to check if any active child exists or not
    public static function hasActiveChild($menu, $currentUrl) {
        
        foreach ($menu as $item) {
            if ($item['href'] == $currentUrl) {
                return true;
            }
            if (!empty($item['children']) && self::hasActiveChild($item['children'], $currentUrl)) {
                return true;
            }
        }
        return false;
    }

    


}
