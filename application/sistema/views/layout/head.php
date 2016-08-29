<?php

$metas = array(
    array('name' => 'description', 'content' =>$description),
    array('name' => 'keywords', 'content' => $keywords),
);

echo "<title>$title_page</title>\n";
echo meta($metas);

#CSS
foreach ($css_layout as $css) {
    echo css_asset($css.'.css');
}

#JS
foreach ($js_layout as $js) {
    echo js_asset($js.'.js');
}

?>
<script>
_base_url = "<?php echo config_item('base_url')?>"
</script>
<link rel="shortcut icon" href="<?php echo image_asset_url('favicon.ico')?>" type="image/x-icon"/>
<link rel="apple-touch-icon" href="<?php echo image_asset_url('favicon.ico')?>" />
<script src="https://player.vimeo.com/api/player.js"></script>