<?php require_once(dirname(__FILE__).'/../templates/header.php'); ?>

<article>
    <div id="mapcontainer">
        <div id="map-canvas" style="height:400px; width:100%;"></div>
    </div>
</article>

<script>
    const googleMapsApiKey = "<?php echo $env["GOOGLE_MAPS_JS_API_KEY"]; ?>";
</script>
<script src="/js/maps-load.js"></script>
<script type="module" src="/js/maps-nearby-search.js"></script>

<?php require_once(dirname(__FILE__).'/../templates/footer.php'); ?>