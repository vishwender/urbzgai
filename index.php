<style type="text/css">
	.ig_feed_container{
    width:100%; margin:0 auto; font-family:Arial, Helvetica, sans-serif;
}
 
.ig_post_container{
    border: 2px solid #f1f1f1; margin-bottom:25px; margin-left:3%; width:20%; height:550px; float:left;
}
 
.ig_post_container img{
    width:100%;
}
 
.ig_post_container .ig_post_details{
    padding:15px;
}
 
.ig_post_container .ig_view_link{
    margin-top:10px;
}
</style>
<?php 
// query the user media
$fields = "id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username";
$token = "IGQVJVdTdIOVBKa0ljdUVSWkFZAYlJBYmlWdGF3OGw5VlFZAS2libjA0VTZAaNDdZAa3F2X1lQck0wSktCdUdxcHBlVjJzLTZAQeEYzMzh5eUN5Sm5kSmRUeV9SVmRKMGY2UFRZAcU52UVB3UVZAUOVd4d0VQbwZDZD";
$limit = 25;
 
$json_feed_url="https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
$json_feed = @file_get_contents($json_feed_url);
$contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
 
echo "<div class='ig_feed_container'>";
    foreach($contents["data"] as $post){
         
        $username = isset($post["username"]) ? $post["username"] : "";
        $caption = isset($post["caption"]) ? $post["caption"] : "";
        $media_url = isset($post["media_url"]) ? $post["media_url"] : "";
        $permalink = isset($post["permalink"]) ? $post["permalink"] : "";
        $media_type = isset($post["media_type"]) ? $post["media_type"] : "";
         
        echo "
            <div class='ig_post_container'>
                <div>";
 
                    if($media_type=="VIDEO"){
                        echo "<video controls style='width:100%; display: block !important;'>
                            <source src='{$media_url}' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video>";
                    }
 
                    else{
                        echo "<img src='{$media_url}' />";
                    }
                 
                echo "</div>
                <div class='ig_post_details'>
                    <div>
                        <strong>@{$username}</strong> {$caption}
                    </div>
                    <div class='ig_view_link'>
                        <a href='{$permalink}' target='_blank'>View on Instagram</a>
                    </div>
                </div>
            </div>
        ";
    }
echo "</div>"
?>