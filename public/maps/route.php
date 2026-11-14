<?php require_once(dirname(__FILE__).'/../templates/header.php'); ?>

<article>
    <div id="mapcontainer">
        <div id="map-canvas" style="height:400px; width:100%;"></div>
    </div>
</article>

        <div class="main-content">
            <div class="control-panel">
                <form id="compute-routes-form">
                    <section>
                        <h2>Input locations</h2>
                        <div class="row">
                            <div class="location-input-wrapper">
                                <label class="text">Origin*</label>
                                <div id="origin-input"></div>
                            </div>
  
                        </div>
                        <div class="row">
                            <div class="location-input-wrapper">
                                <label class="text">Destination*</label>
                                <div id="destination-input"></div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <button class="button-primary" type="submit">
                                Get routes
                            </button>
                        </div>
                    </section>
                </form>
            </div>
        </div>

        <script>
		    const googleMapsApiKey = "<?php echo $env["GOOGLE_MAPS_JS_API_KEY"]; ?>";
        </script>
        <script src="/js/maps-load.js"></script>
        <script type="module" src="/js/maps-routes.js"></script>

<?php require_once(dirname(__FILE__).'/../templates/footer.php'); ?>