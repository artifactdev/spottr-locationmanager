<div id="delete-modal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="row">
              <h2><?php echo "$locationDelete1" ?> <span class="location"></span> <?php echo "$locationDelete2" ?></h2>


          </div>
        </div>
        <div class="clearfix"></div>
    </form>
    <div class="modal-footer">
        <form action="locations/" method="delete" id="delete-form" class="delete-location">
          <button type="submit" class="btn red pull-right"><?php echo "$yes" ?></button>
          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat pull-left"><?php echo "$cancel" ?></a>
        </form>
    </div>
  </div>

