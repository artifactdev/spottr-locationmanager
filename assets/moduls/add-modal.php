<div id="add-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location hinzufügen</h2>
        <div class="modal-body">
            <form action="#" id="add-form" class="add-location">
                <input type="text" placeholder="Titel" name="title"/>

                <input name="datei" type="file" id="file" size="50" maxlength="100000" >

                <select name="category">
                    <option value="industry">Industrie</option>
                    <option value="ruine">Ruine</option>
                    <option value="outdoor">Outdoor</option>
                    
                </select>

                <input type="text" placeholder="Location" name="location"/>

                <input type="text"  id="geocomplete" placeholder="Search Address" name="search_adress"/>

                <input id="lng" name="lng" type="text" value="" placeholder="Longitude">

                <input id="lat" name="lat" type="text" value="" placeholder="Latitude">

                <input type="text" placeholder="Titel" name="title"/>

                <select name="type">
                    <option value="industry">Industrie</option>
                    <option value="ruine">Ruine</option>
                    <option value="outdoor">Outdoor</option>
                    
                </select>

                <input type="text" placeholder="Rating 1-5" name="rating"/>

                <button type="submit" class="btn btn-default full-width">Eintrag speichern</button>
            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>