<div id="delete-modal" class="modal-window hide">
    <div class="modal-wrapper">
        <h2>Location <span class="location"></span> wirklich löschen?</h2>
        <div class="modal-body">
            <form action="http://localhost:8888/spottr/rest-api/locations/" method="delete" id="delete-form" class="delete-location">
               <div class="col-md-6">
                    <button class="btn btn-default full-width modal-close">Abbrechen</button>
               </div>
               <div class="col-md-6">
                    <button type="submit" class="btn btn-red full-width">Ja</button>
               </div>

            </form>
        </div>
        <div class="modal-close"><img src="assets/img/close.png"></div>
    </div>
    <div class="modal-background fade-in"></div>
</div>