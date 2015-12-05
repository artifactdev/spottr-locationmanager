<div id="add-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="row">
        <h2>Location hinzufügen</h2>
        <form action="#" id="add-form-image" class="add-location" enctype='multipart/form-data' method="post" target="js_iframe_location_attachment">
            <div class="file-field input-field">
              <div class="btn">
                <span>Datei</span>
                <input name="datei" type="file" id="file" size="50" maxlength="100000" required accept="image/*;capture=camera">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
        </form><iframe id="js_iframe_location_attachment" name="js_iframe_location_attachment" style="display:none"></iframe>
        <form action="locations" id="add-form" class="add-location" enctype='multipart/form-data'>
            <div class="input-field">
              <input id="title" type="text" name="title" class="validate" required>
              <label for="title">Titel</label>
            </div>

            <select name="category" class="validate" required>
                <option value="Industrie">Industrie</option>
                <option value="Ruine">Ruine</option>
                <option value="Outdoor">Outdoor</option>
            </select>

            <div class="full-width" id="map-add"></div>

            <a href="#" class="getLocation btn btn-default full-width">Aktuelle Position übernehmen</a>

            <div class="input-field">
              <input type="text"  id="geocomplete-search" placeholder="Adresse suchen" type="text" name="search_adress" autocomplete="false"/>
            </div>

            <input id="lng" name="longitude" data-geo="lng" type="text" value="" placeholder="Longitude" class="validate" required>

            <input id="lat" name="latitude" data-geo="lat" type="text" value="" placeholder="Latitude" class="validate" required>

            <select name="type" id="type" class="validate" required>
                <option value="assets/icons/house.png">Gebäude</option>
                <option value="assets/icons/fabrik.png">Fabrik</option>
                <option value="assets/icons/denkmal.png">Denkmal</option>
                <option value="assets/icons/park.png">Park</option>
                <option value="assets/icons/bridge.png">Brücke</option>
                <option value="assets/icons/other.png" selected="selected">Andere</option>
            </select>

            <p class="range-field">
              <label for="rating">Zugänglichkeit</label>
              <input type="range" placeholder="Zugänglichkeit" name="rating" id="rating" required value="0" min="0" max="5" />
            </p>

            <div class="input-field">
              <textarea id="note" name="note" class="materialize-textarea"></textarea>
              <label for="note">Notiz</label>
            </div>

            <input id="aperture" type="hidden" name="aperture" value="0"/>

            <input id="focal" type="hidden" name="focal" value="0"/>

            <input id="iso" type="hidden" name="iso" value="0"/>


      </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer">
      <button type="submit" class="btn">Eintrag speichern</button>
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
      </form>
    </div>
</div>
