<?php

function GetChilds($childid){
    $token = "IGQVJWOVR2UUg2T285UjFheEtTSmlaNlVMYXhLSWpyYl9ELWN2b0loZAW00R1RfQ3g1QjBZAR0lPNXEzMnJpQU94SkhMYXIxRjdjOUJFN3laSGV2ZAXVZAQ182eW1obnJrcGtXUEpucnhvVGYzTHpMWkV6aAZDZD";
    $url = "https://graph.instagram.com/$childid?fields=media_type,media_url&access_token=$token";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $child = curl_exec($curl);
    curl_close($curl);
    $child = json_decode($child, true);
    return $child;
}

$childs = $_POST["childs"];
$childs = explode("-",$childs);
$i = 1;
?>
<div id="widget-view-live" data-component="LayoutType"></div>
<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
    <div class="carousel-inner">
        <?php foreach($childs as $child):
            $img = GetChilds($child);?>
        <div class="item<?php echo $i == 1 ? " active" : ""?>">
            <?php if($img["media_type"] == "IMAGE"):?>
                <img src="<?php echo $img["media_url"]?>">
            <?php else:?>
                <video controls autoplay loop muted class="video">
                    <source src="<?php echo $img["media_url"]?>" type="video/mp4">
                    <source src="<?php echo $img["media_url"]?>" type="video/ogg">
                </video>
            <?php endif;?>
        </div>
        <?php $i++; endforeach;?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>