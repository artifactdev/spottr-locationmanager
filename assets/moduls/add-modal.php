<div id="add-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location hinzufügen</h2>
        <div class="modal-body">
            <form action="locations" id="add-form" class="add-location" enctype='multipart/form-data'>
                <input id="title" type="text" placeholder="Titel" name="title"/>

                <input name="datei" type="file" id="file" size="50" maxlength="100000" >

                <select name="category">
                    <option value="Industrie">Industrie</option>
                    <option value="Ruine">Ruine</option>
                    <option value="Outdoor">Outdoor</option>
                    
                </select>

                <input type="text"  id="geocomplete-search" placeholder="Search Address" name="search_adress"/>

                <input id="lng" name="longitude" data-geo="lng" type="text" value="" placeholder="Longitude">

                <input id="lat" name="latitude" data-geo="lat" type="text" value="" placeholder="Latitude">

                <select name="type" id="type">
                    <option value="assets/icons/house.png">Gebäude</option>
                    <option value="assets/icons/fabrik.png">Fabrik</option>
                    <option value="assets/icons/denkmal.png">Denkmal</option>
                    <option value="assets/icons/park.png">Park</option>
                    <option value="assets/icons/bridge.png">Brücke</option>
                    <option value="assets/icons/other.png" selected="selected">Andere</option>
                </select>
                
                <input class="type-icon" value="assets/icons/store/apparel/umbrella-2.png" type="hidden">

                <input id="rating" type="text" placeholder="Rating 1-5" name="rating"/>

                <input id="aperture" type="hidden" name="aperture"/>

                <input id="date" type="hidden" name="date"/>

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