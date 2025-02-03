<?php
// menu.php
function getAdminMenu($conn)
{
    $query = "SELECT * FROM meniu_admin ORDER BY pozitie";
    $result = mysqli_query($conn, $query);
    return $result;
}

function isActivePage($link)
{
    // Luăm numele paginii curente
    $currentPage = strtolower(basename($_SERVER['PHP_SELF']));

    // Extragem numele paginii din URL-ul complet
    $checkLink = strtolower(basename(parse_url($link, PHP_URL_PATH)));

    // Eliminăm ancorele (#) din link
    $checkLink = str_replace('#', '', $checkLink);

    // Eliminăm spațiile din ambele
    $currentPage = str_replace(' ', '', $currentPage);
    $checkLink = str_replace(' ', '', $checkLink);

    return $currentPage === $checkLink;
}
?>

<div id="sidebar">
    <div class="sidebar-header">
        <a href="http://localhost/testareProiect2/Foundation-Sites-CSS/testTraining2.php#" class="logo">S<B>God</B>.</a>
    </div>
    <ul class="list-unstyled component m-0">
        <?php
        $menuItems = getAdminMenu($con);

        while ($item = mysqli_fetch_assoc($menuItems)) {
            $active = isActivePage($item['link']) ? 'active' : '';
            ?>
            <li class="<?php echo $active; ?>">
                <a href="<?php echo $item['link']; ?>" class="<?php echo $item['clasa']; ?>"
                    id="<?php echo $item['id_element']; ?>">
                    <i class="material-icons"><?php echo $item['icon']; ?></i>
                    <?php echo $item['titlu']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<style>
    .list-unstyled li.active a {
        background: rgba(255, 255, 255, 0.1);
        color: #fff !important;
    }

    .list-unstyled li.active {
        background: rgba(255, 255, 255, 0.1);
        border-left: 4px solid #fff;
    }

    .list-unstyled li.active i {
        color: #fff;
    }

    .list-unstyled li a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff !important;
    }

    .list-unstyled li a {
        text-decoration: none;
        color: #efefef;
        padding: 10px 15px;
        display: block;
    }
</style>