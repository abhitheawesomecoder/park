<?php 
$per_page = 25;         // number of results to show per page
$result = mysql_query("SELECT * FROM $table_name ORDER BY id DESC");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);//total pages we going to have

//-------------if page is setcheck------------------//
if (isset($_GET['page'])) {
    $show_page = $_GET['page'];             //it will telles the current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;              
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}
// display pagination
$page = intval($_GET['page']);

$tpages=$total_pages;
if ($page <= 0)
    $page = 1;
	
	
function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "<font style='font-size: 18px;'>&lsaquo;</font>&nbsp; ".$LANG['TITLE_PREVIOUS'];
    $nextlabel = "".$LANG['TITLE_NEXT']." &nbsp;<font style='font-size: 18px;'>&rsaquo;</font>";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<span>" . $prevlabel . "</span>\n";
    } elseif ($page == 2) {
        $out.= "<li><a  href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li>";
    } else {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
    }
  
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a  href=\"" . $reload . "\">" . $i . "</a>\n</li>";
        } else {
            $out.= "<li><a  href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a>\n</li>";
        }
    }
    
    
    // next
    if ($page < $tpages) {
        $out.= "<li><a  href=\"" . $reload . "&amp;page=" . ($page + 1) . "\">" . $nextlabel . "</a>\n</li>";
    } else {
        $out.= "<span style='font-size:11px'>" . $nextlabel . "</span>\n";
    }
    $out.= "";
    return $out;
}



$reload = $root."/"."index.php?view=admin&action=".$_GET['action']."";
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
?>