<?php
include('./connection/database.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CALEB BLOG</title>
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="stylesheet" href="./style/modified.css" />
    <script src="./js/main.js"></script>
    <link rel="stylesheet" href="./style/mobile.css" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
</head>

<body>
    <div class="heading">
        <div class="headingcontent">
            <div class="blogname">
                <span onclick="window.location.href='./index.php'">C4L3B21</span>
            </div>

            <div class="navigation">
                <div class="thelinks">
                    <a href='./index.php'>Home</a>
                    <a href=''>About</a>
                    <a href="#news">Latest News</a>
                </div>
                <div class="searchblog">
                    <input type="text" id="inputBar" placeholder="search our blog" onkeydown="searchBlog(event)" />
                    <span class="material-symbols-outlined"> search </span>
                </div>

                <p onclick="showNav()" id='menuside'>&#9776</p>
            </div>
        </div>
    </div>

    <div id="sideNav" class="sideNavigation">
        <div class="themenucontent">
            <span onclick="hideNav()">x</span>
            <div class="links">
                <a href='./index.php'>Home</a>
                <a href=''>About</a>
                <a href="#news">Latest News</a>
                <a href="#news">Use API</a>
            </div>
        </div>
    </div>

    <div class="theblogcotainerbody">
        <div class="theherosection">
            <img src="image/cyber-security-concept-digital-art.jpg" alt />
        </div>

        <div class="thebodyText">
            <h2>Safeguard Your Digital World with the Latest in
                Cybersecurity</h2>
            <span>Stay a step ahead with insights, strategies, and tools to
                protect
                your data, privacy, and digital assets. Explore expert
                advice to
                navigate the ever-evolving landscape of cyber threats and
                defenses.</span>
        </div>
    </div>

    <div class="theBlogs" id="news">

        <?php
        $listedBlog = $_GET['bloglist'] ?? '3';
        if ($listedBlog == '3') {
            $fetchAllBlog = "SELECT * FROM blog_schema ORDER BY `id` DESC LIMIT $listedBlog";
            $querySql = $connection->query($fetchAllBlog);
            $countBlog = mysqli_num_rows($querySql);
            if ($countBlog > 0) {
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

                echo 'no blog post yet';
            }
        } else if ($listedBlog == 'all') {
            $fetchAllBlog = "SELECT * FROM blog_schema ORDER BY `id` DESC";
            $querySql = $connection->query($fetchAllBlog);
            $countBlog = mysqli_num_rows($querySql);
            if ($countBlog > 0) {
                while ($blogRow = mysqli_fetch_assoc($querySql)) {


                    $sText = substr($blogRow['blog_description'], 0, 150);
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
                <h2>{$blogRow['blog_name']}</h2><span>{$sText}...</span>
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

                echo 'no blog post yet';
            }
        } else {
            echo 'an error has occur';
        }
        ?>


        <div class="viewall">
            <a href="?bloglist=all">View all blog</a>
        </div>
    </div>

    <div class="footer">
        <div class="head">
            <h2>Safeguard Your Digital World with the Latest in Cybersecurity</h2>
        </div>

        <div class="accessiblelinks">
            <div class="quicklink">
                <span>Quick links</span>

                <div class="links">
                    <a href="">Home</a>
                    <a href="">Connect with creator</a>
                    <a href="">Blogs</a>
                    <a href="">Join community</a>
                    <a href="">Use API</a>
                </div>
            </div>

            <div class="quicklink">
                <span>Join our newsletter</span>

                <div class="links">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="Enter your email">
                    <button>Subscribe</button>
                </div>
            </div>

            <div class="quicklink">
                <span>Follow Our Blog</span>

                <div class="links">
                    <i class="ri-facebook-circle-fill"></i>
                    <i class="ri-twitter-x-line"></i>
                    <i class="ri-whatsapp-fill"></i>
                </div>
            </div>
        </div>
    </div>
</body>

</html>