<?php
include('./connection/database.php');
$searchParam = $_GET['search_query'] ?? '';
if (empty($searchParam)) {
    echo '';
} else {
    $database = "SELECT * FROM blog_schema WHERE blog_name LIKE '%$searchParam%'";
    $querySql = $connection->query($database);
    $countdata = mysqli_num_rows($querySql);
    if ($countdata > 0) {
        while ($blogRow = mysqli_fetch_assoc($querySql)) {


            $sText = substr($blogRow['blog_description'], 0, 300);
            $linkToBlog = implode('_', explode(' ', $blogRow['blog_name']));
            $listAllBlog = "<a href='./blogs/{$linkToBlog}'>
    <div class='theblogcontainer'>
        <div class='theimagecontainer'><img src='{$blogRow['image']}' alt /></div>
        <div class='thetextContent'>
            <div class='theheading'>
                <div class='adminImage'><img src='image/cyber-security-concept-digital-art.jpg' alt /></div>
                <div class='theNameAndData'><span>Caleb</span><span>{$blogRow['date']}</span></div>
            </div>
            <div class='themainBlog'>
                <p>{$blogRow['blog_name']}</p><span>{$sText}...</span>
            </div>
            <div class='thebuttonshare'>
                <hr />
                <div class='shareto'>
                    <div class='share'><span>Share this blog</span></div>
                    <div class='theplatfor'><i class='ri-facebook-circle-fill'></i><i class='ri-twitter-x-line'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>";

echo $listAllBlog;
        }
    } else {
        echo 'blog not found';
    }
}
