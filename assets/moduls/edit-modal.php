<div id="edit-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location bearbeiten</h2>
        <div class="modal-body">
            <form action="locations/" id="edit-form" method="put" class="edit-location">

                <input id="title" type="text" placeholder="Titel" name="title" required/>

                <input name="datei" type="file" id="file" size="50" maxlength="100000" required>

                <select name="category" required>
                    <option value="Industrie">Industrie</option>
                    <option value="Ruine">Ruine</option>
                    <option value="Outdoor">Outdoor</option>
                    
                </select>

                <input type="text"  id="geocomplete-edit" placeholder="Search Address" name="search_adress"/>

                <input id="lng" name="lng" type="text" value="" placeholder="Longitude" required>

                <input id="lat" name="lat" type="text" value="" placeholder="Latitude" required>

                <select name="type" required>
                    <option value="assets/icons/house.png">Gebäude</option>
                    <option value="assets/icons/fabrik.png">Fabrik</option>
                    <option value="assets/icons/denkmal.png">Denkmal</option>
                    <option value="assets/icons/park.png">Park</option>
                    <option value="assets/icons/bridge.png">Brücke</option>
                    <option value="assets/icons/other.png" selected="selected">Andere</option>
                </select>

                <input id="rating" type="text" placeholder="Rating 1-5" name="rating" required min="1" max="5" maxlength="1"/>

                <input id="aperture" type="hidden" name="aperture"/>

                <input id="focal" type="hidden" name="focal"/>

                <input id="iso" type="hidden" name="iso"/>

                <button type="submit" class="btn btn-default full-width">Eintrag speichern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>