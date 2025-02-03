<?php
require_once 'config.php';
require_once 'connection.php';

// Fetch menu items
$menu_query = "SELECT id, title, link, menu_item_icon, parent_id FROM menu_items ORDER BY parent_id, id";
$menu_result = mysqli_query($conn, $menu_query);
$menu_items = mysqli_fetch_all($menu_result, MYSQLI_ASSOC);

// Fetch page content
$content_query = "SELECT * FROM page_content";
$content_result = mysqli_query($conn, $content_query);
$page_content = mysqli_fetch_all($content_result, MYSQLI_ASSOC);

// Function to build menu
function buildMenu($items, $parent = 0)
{
    $html = '';
    foreach ($items as $item) {
        if ($item['parent_id'] == $parent) {
            $html .= '<li><a href="' . $item['link'] . '">' . $item['title'] . '</a>';
            $html .= buildMenu($items, $item['id']);
            $html .= '</li>';
        }
    }
    return $html ? '<ol>' . $html . '</ol>' : '';
}

// Function to get content by section
function getContent($content, $section)
{
    foreach ($content as $item) {
        if ($item['section'] == $section) {
            return $item;
        }
    }
    return null;
}
$popup_query = "SELECT * FROM page_content WHERE section LIKE 'popup_%'";
$popup_result = mysqli_query($conn, $popup_query);
$popup_content = mysqli_fetch_all($popup_result, MYSQLI_ASSOC);

// Function to get popup content
function getPopupContent($content, $section)
{
    foreach ($content as $item) {
        if ($item['section'] == $section) {
            return $item;
        }
    }
    return null;
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <title>Sculpted By God</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styleN.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/styleTest.css">
    <link rel="icon" href="img/icon.png">
</head>

<body>
    <div class="navbar">
        <a href="http://localhost/testareProiect2/Foundation-Sites-CSS/testTraining2.php" class="logo">S<B>God</B>.</a>
        <div class="toggle" onclick="navToggle();"></div>
        <?php echo buildMenu($menu_items); ?>
    </div>

    <section id="home" class="home view">
        <?php $home_content = getContent($page_content, 'home'); ?>
        <div class="highlights">
            <h1><?php echo $home_content['title']; ?></h1><br>
            <p class="tagline"><?php echo $home_content['content']; ?></p>
            <button class="join" onclick="openNewPage()">Incepe</button>
        </div>
        <div class="banner"></div>
    </section>

    <script>
        function openNewPage() {
            window.location.href = "http://localhost/testareProiect2/Foundation-Sites-CSS/interfata%20login.php";
        }
    </script>

    <section id="about" class="about view">
        <?php $about_content = getContent($page_content, 'about'); ?>
        <div class="main">
            <h2><span>D</span>espre noi</h2>
            <h6><?php echo $about_content['title']; ?></h6>
        </div>
        <div class="footer-image">
            <img src="css/main/gg4.jpg" alt="Footer image">
        </div>
        <div class="content">
            <?php echo $about_content['content']; ?>
        </div>
    </section>

    <!-- Trainers section -->
    <section id="trainers" class="trainers view">
        <?php $trainers_content = getContent($page_content, 'trainers'); ?>
        <div class="main">
            <h2><span>A</span>ntrenori</h2>
            <h6><?php echo $trainers_content['title']; ?></h6>
        </div>
        <section id="tranding">
            <div class="container">
                <div class="swiper tranding-slider">
                    <div class="swiper-wrapper">
                        <?php
                        $trainers = json_decode($trainers_content['content'], true);
                        foreach ($trainers as $trainer) {
                            echo '<div class="swiper-slide tranding-slide">
                            <div class="tranding-slide-img">
                                <img src="' . $trainer['image'] . '" alt="Trainer">
                                <div class="hover-overlay">
                                    <button class="choose-me-btn" onclick="openNewPage()">Alege-mă</button>
                                </div>
                            </div>
                            <div class="tranding-slide-content">
                                        <h1 class="trainer-nr">' . $trainer['experience'] . '</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="trainer-name">' . $trainer['name'] . '</h2>
                                            <h3 class="trainer-rating">
                                                <span>' . $trainer['rating'] . '</span>
                                                <div class="rating">
                                                    ' . str_repeat('<ion-icon name="star"></ion-icon>', 5) . '
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                    </div>
                    <!-- Slider controls -->
                    <div class="tranding-slider-control">
                        <div class="swiper-button-prev slider-arrow">
                            <ion-icon name="arrow-back-outline"></ion-icon>
                        </div>
                        <div class="swiper-button-next slider-arrow">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <footer>
        <div class="footerContainer" id="contact">
            <?php $contact_content = getContent($page_content, 'contact'); ?>
            <div class="main">
                <h2><span>C</span>ontact</h2>
            </div>
            <div class="socialIcons">
                <a href="https://www.linkedin.com/in/georgiana-alexandra-pop/"><i
                        class="icon ion-social-linkedin"></i></a>
                <a href="https://github.com/pqeorqiana"><i class="icon ion-social-github"></i></a>
                <a href="https://x.com/pqeorqiana"><i class="icon ion-social-twitter"></i></a>
            </div>
            <div class="contact-info">
                <?php echo $contact_content['content']; ?>
            </div>
            <div class="footer-links">
                <a href="javascript:void(0);" class="footer-popup-link" onclick="openPopup('aboutMePopup')">About Me</a>
                <a href="javascript:void(0);" class="footer-popup-link" onclick="openPopup('termsPopup')">Terms of
                    Service</a>
                <a href="javascript:void(0);" class="footer-popup-link"
                    onclick="openPopup('privacyPolicyPopup')">Privacy Policy</a>
            </div>
        </div>
        <div class="footerBottom">
            <p>Copyright &copy;2023 Sculpted by God - Pop Georgiana Alexandra</p>
        </div>
    </footer>



    <!-- Pop-up windows -->
    <?php
    $popup_sections = ['popup_about_me', 'popup_terms', 'popup_privacy'];
    $popup_ids = ['aboutMePopup', 'termsPopup', 'privacyPolicyPopup'];

    for ($i = 0; $i < count($popup_sections); $i++) {
        $popup = getPopupContent($popup_content, $popup_sections[$i]);
        if ($popup) {
            echo '<div class="popup" id="' . $popup_ids[$i] . '">
            <div class="popup-content">
                <span class="close" onclick="closePopup(\'' . $popup_ids[$i] . '\')">&times;</span>
                <h3>' . htmlspecialchars($popup['title']) . '</h3>
                <p>' . htmlspecialchars($popup['content']) . '</p>
            </div>
        </div>';
        }
    }
    ?>

    <script>
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "block";
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = "none";
        }

        // Close pop-up if user clicks outside of it
        window.onclick = function (event) {
            const popups = document.querySelectorAll('.popup');
            popups.forEach(popup => {
                if (event.target == popup) {
                    popup.style.display = "none";
                }
            });
        }
    </script>

    <!-----------------------------script pt icons, swiper(slide f card) and the navbar that scrolls-------------------------->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script2.js"></script>
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle("sticky", window.scrollY > 50);
        })
        const togglebar = document.querySelector('.toggle');
        const menu = document.querySelector('.ol');
        function navToggle() {
            var navList = document.querySelector('.navbar ol');
            navList.classList.toggle("active");
            togglebar.classList.toggle('active');
            menu.classList.toggle('active');
        }
    </script>

    <!------------------------------------------------------------sfarsit--------------------------------------------------->
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>