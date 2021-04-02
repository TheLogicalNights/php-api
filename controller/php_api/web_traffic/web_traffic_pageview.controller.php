<?php
    header("Access-Control-Allow-Origin: *");
    //include database and table files
    include ("/var/www/html/php-api/model/config/path.model.php");
    include ("$model/config/database.model.php");
    include ("$model/pageview.model.php");

    $db = new Database();
    $conn = $db->getConnection();
    $page_view = new PageView($conn);

    $stmt = $page_view->viewPageView();
    $num = $stmt->rowCount();
    $traffic_page_view = array();
    if($num>0)
    {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $traffic_page_view = array(
                "pageview"  => $count
            );
            http_response_code(200);
            echo json_encode($traffic_page_view);
        }
    }
?>