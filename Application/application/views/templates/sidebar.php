<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- icon home -->
            <i class="fas fa-fw fa-truck-moving"></i>
        </div>
        <!-- title sidebar -->
        <div class="sidebar-brand-text mx-3">Invenventory</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- QUERY DARI MENU -->

    <?php

    $role_id = $this->session->userdata('role_id');
    // - Select column mana yang mau ditampilin
    // - Dari table 1 JOIN ke tabel 2
    // - ON -> untuk mengunci primary key dari masing-masing tabelnya
    // - kondisinya
    // - ORDER BY -> untuk mengurutkan berdasarkan menu_id, ASC -> terurut naik
    $queryMenu = " SELECT `user_menu`.`id`,`menu` 
                    FROM `user_menu` JOIN `user_access_menu` 
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
    //run the query
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- Looping Menu -->
    <?php foreach ($menu as $menus) : ?>
        <div class="sidebar-heading">
            <!-- access the role title menu -->
            <?= $menus['menu']; ?>
        </div>

        <!-- Sub-MENU sesuai Menu -->
        <?php
            // sub-menu
            $menuID = $menus['id'];
            //  - Select all submenu from table user_sub_menu
            //  - from table user sub menu JOIN ke tabel user_menu
            //  - foreign key user sub menu = primary key user_menu, PK di user_menu jadi FK di user_sub_menu
            //  - where kondisinya mengecek menu_id yg dari $menus ke menu_id di table user_sub_menu
            //  - AND -> untuk cek sub_menunya aktif atau tidak
            $querySubMenu = "SELECT *
                            FROM `user_sub_menu` JOIN `user_menu` 
                            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                            WHERE `user_sub_menu`.`menu_id` = $menuID
                            AND `user_sub_menu`.`is_active` = 1
        ";
            // run the query kumpulan submenu dari menu
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>
        <?php foreach ($subMenu as $subMenus) : ?>
            <!-- Kondisi ketika menu bold after click -->
            <?php if ($title == $subMenus['title_submenu']) : ?>
                <!-- active -> tulisan menu bold -->
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($subMenus['url']) ?>">
                    <i class="<?= $subMenus['icon'] ?>"></i>
                    <span><?= $subMenus['title_submenu'] ?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider mt-2">

        <?php endforeach; ?>
        <!-- End of Looping-menu -->
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log out</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->