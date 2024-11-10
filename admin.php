<?php
include './connection/database.php'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>C4L3B21 BLOG (admin)</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='../js/main.js'></script>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="../style/modified.css" />
    <link rel="stylesheet" href="../style/mobile.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />

    <link href="https://iconsax.gitlab.io/i/icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <div class='heading'>
        <div class='headingcontent'>
            <div class='blogname'>
                <span onclick="window.location.href='../index.php'">C4L3B21</span>
            </div>

            <div class='navigation'>
                <div class='thelinks'>
                    <a href='../index.php'>Home</a>
                    <a href=''>About</a>
                    <a href='../index.php#news'>Latest News</a>
                </div>
                <div class='searchblog'>
                    <input type='text' placeholder='search our blog' />
                    <span class='material-symbols-outlined'> search </span>
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


    <div class="blogcontent">
        <div class="adminpanel">
            <span>SHARE NEW BLOG POST</span>
            <div class="theinputs">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="key" placeholder="Enter access key">
                    <input type="text" name="title" placeholder="Blog title">
                    <textarea name="description" id="" placeholder="Enter blog description"></textarea>
                    <input type="file" name="file" id="">
                    <button name="submit">Share new update</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                    function validate($data)
                    {
                        $data = trim($data);
                        $data = htmlspecialchars($data);
                        $data = stripslashes($data);
                        return $data;
                    }
                    $accessKey = validate($_POST['key']);
                    $blogTitle = validate($_POST['title']);
                    $description = validate($_POST['description']);
                    $date = date('M - d - Y');

                    if (empty($accessKey && $blogTitle && $description)) {
                        echo "<p id='backend'>Input cannot be empty</p>";
                    } else if ($accessKey !== 'calabsec05@1') {
                        echo "<p id='backend'>Invalid access key</p>";
                    } else {
                        $file = $_FILES['file']['name'];
                        $temporary = $_FILES['file']['tmp_name'];
                        $fix = explode('.', $file);
                        $fileExten = end($fix);
                        $extention = array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");

                        if (!in_array($fileExten, $extention)) {
                            # code...
                            $err = "<p class='err'>Invalid Image</p>";
                            echo $err;
                        } else {
                            $unique = "caleb" . rand(time(), 8392) . rand(time(), 87282792);
                            $image = "image/" . $unique . $file;
                            if (move_uploaded_file($temporary, $image)) {
                                //prepare to send information to the database
                                $sql = "INSERT INTO blog_schema(blog_name, blog_description, image, date ) VALUES ('$blogTitle', '$description', '$image', '$date')";
                                if ($connection->query($sql)) {
                                    //build a raw file blog content
                                    $createfile = fopen('blogs/' . implode('_', explode(' ', $blogTitle)) . '.html', mode: 'w') or die('an error has occur');
                                    //write content into the file
                                    $content = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>{$blogTitle}</title>
    <link rel='stylesheet' href='../style/style.css' />
    <link rel='stylesheet' href='../style/modified.css' />
        <link rel='stylesheet' href='../style/mobile.css'>
    <script src='../js/main.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/remixicon@4.4.0/fonts/remixicon.css' rel='stylesheet' />
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search' />
</head>

<body>
    <div class='heading'>
        <div class='headingcontent'>
            <div class='blogname'>
                <span  onclick='window.location.href='../index.php''>C4L3B21</span>
            </div>

            <div class='navigation'>
                <div class='thelinks'>
                  <a href='./index.php'>Home</a>
                    <a href=''>About</a>
                    <a href='../index.php#news'>Latest News</a>
                </div>
                <div class='searchblog'>
                    <input type='text' placeholder='search our blog' />
                    <span class='material-symbols-outlined'> search </span>
                </div>

                <p onclick='showNav()' id='menuside'>&#9776</p>
            </div>
        </div>
    </div>

        <div id='sideNav' class='sideNavigation'>
        <div class='themenucontent'>
            <span onclick='hideNav()'>x</span>
            <div class='links'>
                <a href='./index.php'>Home</a>
                <a href=''>About</a>
                <a href='#news'>Latest News</a>
                <a href='#news'>Use API</a>
            </div>
        </div>
    </div>

    <div class='theBlogs'>
        <div class='theoverallcontent'>
            <div class='headoftemplate'>
                <img src='../image/84770f_df0bdbbdd9a94259858e70cbba33897f~mv2_d_3538_2359_s_2.webp' alt=''>
                <span>Calab .
                                {$date}</span>
            </div>

            <div class='theblogitself'>
                <h2>{$blogTitle}</h2>
                <span>{$description}</span>

                <div class='imagecontainer'>
                    <img src='../{$image}' alt=''>
                </div>
            </div>

            <div class='thebuttonshare'>
                <hr />

                <div class='shareto'>
                    <div class='share'>
                        <span>Share this blog</span>
                    </div>

                    <div class='theplatfor'>
                        <i onclick='shareto(`facebook`, window.location.href)' class='ri-facebook-circle-fill'></i>
                        <i onclick='shareto(`twitter`, window.location.href)' class='ri-twitter-x-line'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class='footer'>
        <div class='head'>
            <h2>Safeguard Your Digital World with the Latest in Cybersecurity</h2>
        </div>

        <div class='accessiblelinks'>
            <div class='quicklink'>
                <span>Quick links</span>

                <div class='links'>
                    <a href=''>Home</a>
                    <a href=''>Connect with creator</a>
                    <a href=''>Blogs</a>
                    <a href=''>Join community</a>
                </div>
            </div>

            <div class='quicklink'>
                <span>Join our newsletter</span>

                <div class='links'>
                    <label for='email'>Email</label>
                    <input type='text' id='email' placeholder='Enter your email'>
                    <button>Subscribe</button>
                </div>
            </div>

            <div class='quicklink'>
                <span>Follow Our Blog</span>

                <div class='links'>
                    <i class='ri-facebook-circle-fill'></i>
                    <i class='ri-twitter-x-line'></i>
                    <i class='ri-whatsapp-fill'></i>
                </div>
            </div>
        </div>
    </div>
</body>

</html>";
                                    $writeInto = fwrite($createfile, $content);
                                    echo
                                    "<div class='heyblog'>
                                            <div class='blogNoti'>
                                            <p>update has been created copy link</p>
                                            </div>
                                        </div>";
                                    fclose($createfile);
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>