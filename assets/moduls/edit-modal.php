<div id="edit-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location bearbeiten</h2>
        <div class="modal-body">
            <form action="#" id="edit-form-image" class="edit-location" enctype='multipart/form-data' method="post" target="js_iframe_location_attachment">
                <input name="datei" type="file" id="file" size="50" maxlength="100000" required>
            </form><iframe id="js_iframe_location_attachment" name="js_iframe_location_attachment" style="display:none"></iframe>
            <form action="locations/" id="edit-location-form" method="put" class="edit-location">

                <input id="title" type="text" placeholder="Titel" name="title" required/>

                <select name="category" required>
                    <option value="Industrie">Industrie</option>
                    <option value="Ruine">Ruine</option>
                    <option value="Outdoor">Outdoor</option>
                    
                </select>

                <div id="map-edit"></div>

                <input id="lng" name="lng" type="text" value="" placeholder="Longitude" disabled>

                <input id="lat" name="lat" type="text" value="" placeholder="Latitude" disabled>

                <select name="type" required>
                    <option value="assets/icons/house.png">Gebäude</option>
                    <option value="assets/icons/fabrik.png">Fabrik</option>
                    <option value="assets/icons/denkmal.png">Denkmal</option>
                    <option value="assets/icons/park.png">Park</option>
                    <option value="assets/icons/bridge.png">Brücke</option>
                    <option value="assets/icons/other.png" selected="selected">Andere</option>
                </select>

                <input id="rating" type="number" placeholder="Rating 1-5" name="rating" required min="1" max="5" maxlength="1"/>

                <input id="aperture" type="hidden" name="aperture"/>

                <input id="focal" type="hidden" name="focal"/>

                <input id="iso" type="hidden" name="iso"/>

                <button type="submit" class="btn btn-default full-width">Eintrag speichern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
    <iframe class="hide" name="fnJS_iframe_location_attachment" id="fnJS_iframe_location_attachment"></iframe>
</div>