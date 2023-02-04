<?php
    $menu = array(
        'channels' => array(
            'link' => 'index.php?t=channels',
            'name' => 'Каналы'
        ),
        'favorites' => array(
            'link' => 'index.php?t=favorites',
            'name' => 'Доверенные'
        ),
        'fields' => array(
            'link' => 'index.php?t=fields',
            'name' => 'Знания'
        )
    );
?>
<ul class="tab tab-block">
    <?php
        foreach($menu as $key => $item) {
            $badge = get_badge($DATABASE, $key);
            ?>
            <li class="menu-item tab-item <?=($key == $_SESSION['tab'] ? 'active' : '')?>"><a href="<?=$HOST?>/<?=$item['link']?>"><?=$item['name']?> <span class="label"><?=$badge?></span></a></li>
            <?php
        }
    ?>
</ul>