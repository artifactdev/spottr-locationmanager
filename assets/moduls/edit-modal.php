<div id="edit-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="row">
            <h2><?php echo "$changeLocation" ?></h2>
            <form action="#" id="add-form-image" class="add-location" enctype='multipart/form-data' method="post" target="js_iframe_location_attachment">
                <div class="file-field input-field">
                  <div class="btn">
                    <span><?php echo "$file" ?></span>
                    <input name="file" type="file" id="file" size="50" maxlength="100000" required accept="image/*;capture=camera">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
            </form><iframe id="js_iframe_location_attachment" name="js_iframe_location_attachment" style="display:none"></iframe>
            <form action="locations" id="add-form" class="add-location" enctype='multipart/form-data'>
                <div class="input-field">
                  <input id="title" type="text" name="title" class="validate" required>
                  <label for="title"><?php echo "$title" ?></label>
                </div>

                <select name="category" class="validate" required>
                    <option value="Industrie"><?php echo "$industry" ?></option>
                    <option value="Ruine"><?php echo "$ruine" ?></option>
                    <option value="Outdoor"><?php echo "$outdoor" ?></option>
                </select>

                <div class="full-width" id="map-edit"></div>

                <a href="#" class="getLocation btn btn-default full-width"><?php echo "$actualPosition" ?></a>

                <div class="input-field">
                  <input type="text"  id="geocomplete-search" placeholder="<?php echo "$searchAdress" ?>" type="text" name="search_adress" autocomplete="false"/>
                </div>

                <input id="lng" name="longitude" data-geo="lng" type="text" value="" placeholder="Longitude" class="validate" required>

                <input id="lat" name="latitude" data-geo="lat" type="text" value="" placeholder="Latitude" class="validate" required>

                <select name="type" id="type" class="validate" required>
                    <option value="assets/icons/house.png"><?php echo "$house" ?></option>
                    <option value="assets/icons/fabrik.png"><?php echo "$fabrik" ?></option>
                    <option value="assets/icons/denkmal.png"><?php echo "$denkmal" ?></option>
                    <option value="assets/icons/park.png"><?php echo "$park" ?></option>
                    <option value="assets/icons/bridge.png"><?php echo "$bridge" ?></option>
                    <option value="assets/icons/other.png" selected="selected"><?php echo "$other" ?></option>
                </select>

                <p class="range-field">
                  <label for="rating"><?php echo "$rating" ?></label>
                  <input type="range" placeholder="<?php echo "$rating" ?>" name="rating" id="rating" required value="0" min="0" max="5" />
                </p>

                <div class="input-field">
                  <textarea id="note" name="note" class="materialize-textarea"></textarea>
                  <label for="note"><?php echo "$note" ?></label>
                </div>

                <input id="aperture" type="hidden" name="<?php echo "$aperture" ?>" value="0"/>

                <input id="focal" type="hidden" name="<?php echo "$focal" ?>" value="0"/>

                <input id="iso" type="hidden" name="<?php echo "$iso" ?>" value="0"/>


          </div>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="modal-footer">
        <button type="submit" class="btn pull-right"><?php echo "$saveEntry" ?></button>
        <a href="#!" class=" modal-action modal-<?php echo "$close" ?> waves-effect waves-green btn-flat pull-left"><?php echo "$close" ?></a>
        </form>
    </div>
  </div>

