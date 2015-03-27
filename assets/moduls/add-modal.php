<div id="add-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location hinzufügen</h2>
        <div class="modal-body">
            <form action="#" id="add-form" class="add-location">
                <input type="text" placeholder="Titel" name="title"/>

                <input name="datei" type="file" id="file" size="50" maxlength="100000" >

                <select name="category">
                    <option value="Industrie">Industrie</option>
                    <option value="Ruine">Ruine</option>
                    <option value="Outdoor">Outdoor</option>
                    
                </select>

                <input type="text"  id="geocomplete" placeholder="Search Address" name="search_adress"/>

                <input id="lng" name="lng" type="text" value="" placeholder="Longitude">

                <input id="lat" name="lat" type="text" value="" placeholder="Latitude">

                <select name="type">
                    <option value="Gebaeude">Gebäude</option>
                    <option value="Fabrik">Fabrik</option>
                    <option value="Denkmal">Denkmal</option>
                </select>

                <input type="text" placeholder="Rating 1-5" name="rating"/>

                <input type="hidden" name="aperture"/>

                <input type="hidden" name="date"/>

                <input type="hidden" name="focal"/>

                <input type="hidden" name="iso"/>

                <button type="submit" class="btn btn-default full-width">Eintrag speichern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>