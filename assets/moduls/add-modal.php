<div id="add-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location hinzufügen</h2>
        <div class="modal-body">

            <form action="#" id="add-form-image" class="add-location" enctype='multipart/form-data' method="post" target="js_iframe_location_attachment">
                <input name="datei" type="file" id="file" size="50" maxlength="100000" >
            </form><iframe id="js_iframe_location_attachment" name="js_iframe_location_attachment" style="display:none"></iframe>
            <form action="locations" id="add-form" class="add-location" enctype='multipart/form-data'>
                <input id="title" type="text" placeholder="Titel" name="title"/>

                <select name="category" required>
                    <option value="Industrie">Industrie</option>
                    <option value="Ruine">Ruine</option>
                    <option value="Outdoor">Outdoor</option>
                    
                </select>

                <div class="full-width" id="map-add" style="height:150px"></div>

                <input type="text"  id="geocomplete-search" placeholder="Search Address" name="search_adress" autocomplete="false"/>

                <input id="lng" name="longitude" data-geo="lng" type="text" value="" placeholder="Longitude" required>

                <input id="lat" name="latitude" data-geo="lat" type="text" value="" placeholder="Latitude" required>

                <select name="type" id="type" required>
                    <option value="assets/icons/house.png">Gebäude</option>
                    <option value="assets/icons/fabrik.png">Fabrik</option>
                    <option value="assets/icons/denkmal.png">Denkmal</option>
                    <option value="assets/icons/park.png">Park</option>
                    <option value="assets/icons/bridge.png">Brücke</option>
                    <option value="assets/icons/other.png" selected="selected">Andere</option>
                </select>

                <input type="number" placeholder="Zugänglichkeit 1-5" name="rating" required min="1" max="5" maxlength="1"/>

                <input id="aperture" type="hidden" name="aperture" value="0"/>

                <input id="focal" type="hidden" name="focal" value="0"/>

                <input id="iso" type="hidden" name="iso" value="0"/>

                <button type="submit" class="btn btn-default full-width">Eintrag speichern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
    <iframe class="hide" name="fnJS_iframe_location_attachment" id="fnJS_iframe_location_attachment"></iframe>
</div>