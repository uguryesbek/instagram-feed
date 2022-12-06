<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="insta.css">

</head>

<?php
function instagramGetPost()
{
    $token = "IGQVJWOVR2UUg2T285UjFheEtTSmlaNlVMYXhLSWpyYl9ELWN2b0loZAW00R1RfQ3g1QjBZAR0lPNXEzMnJpQU94SkhMYXIxRjdjOUJFN3laSGV2ZAXVZAQ182eW1obnJrcGtXUEpucnhvVGYzTHpMWkV6aAZDZD";
    $url = "https://graph.instagram.com/me/media?fields=thumbnail_url,children,media_type,media_url,username,permalink,timestamp,caption&access_token=$token";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $request = curl_exec($curl);
    curl_close($curl);
    $request = json_decode($request, true);
    return $request;
}

$media = instagramGetPost();

//print_r($media);
?>

<body>

<!-- -------------------------------------------------------------------- -->
<?php foreach ($media['data'] as $instagrampost):?>
        <a href="<?php echo $instagrampost['permalink'] ?>" target="_blank" class="instapost">
            <img src="<?php echo $instagrampost["media_type"] == "VIDEO" ? $instagrampost['thumbnail_url'] : $instagrampost['media_url'] ?>" 
                data-type="<?=$instagrampost["media_type"]?>" 
                data-caption="<?php echo isset($instagrampost["caption"]) ? htmlspecialchars_decode($instagrampost["caption"]) : "";?>" 
                data-username="<?php echo $instagrampost["username"]?>" 
                data-time = "<?php echo $instagrampost['timestamp']?>" 
                data-postlink="<?php echo $instagrampost['permalink']?>"
                data-media_url = "<?php echo $instagrampost["media_url"]?>">
            <?php if(isset($instagrampost['children']["data"])):
                foreach($instagrampost['children']["data"] as $child):?>
                <span style="display:none;" value="<?php echo $child["id"]?>"><?php echo $child["id"]?></span>
            <?php endforeach;endif;?>
        </a>
    <?php endforeach;?>
    <div id="widget-view-live" data-component="LayoutType"></div>
    <div class="popup" id="popup">
        <div class="popup-inner">
            <div class="popup__photo">
                
            </div>
        <div class="popup__text">
            <a href="#" target="_blank" rel="nofollow"><span class="title"></span></a>
            <a href="#" class="postlink" target="_blank" rel="nofollow"><img src="instagram.svg" alt="instagram logo" class="ilogo"></a>
            <p class="date"></p>
            <div class="content"></div>
        </div>
        <a class="popup__close" href="#">X</a>
        </div>
    </div>
<!-- -------------------------------------------------------------------- -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="insta.js"></script>
<!-- -------------------------------------------------------------------- -->
</body>
</html>