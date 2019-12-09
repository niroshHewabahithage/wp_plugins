<?php
//Feb 20, 2019 8:45:01 AM 
?>
<nav id="page-leftbar" role="navigation">
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(ADMIN_URL); ?>">
    <ul class="acc-menu" id="sidebar">
        <li id="search">
            <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
            <form>
                <input type="text" class="search-query" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </li>
        <li class="divider"></li>
        <li><a href="index.htm"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <?php
        if (isset($admin_menu)) {
            foreach ($admin_menu as $key => $value) {
                ?>
                <li><a href="javascript:;"><i class="<?php echo $value[0]->main_icon_class ?>"></i> <span><?php echo $key; ?></span> </a>
                    <ul class="acc-menu">
                        <?php
                        foreach ($value as $__value) {
                            ?>
                            <li><a href="<?php echo base_url(ADMIN_URL); ?><?php echo $__value->url; ?>"><span><?php echo $__value->menu_name ?></span></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>