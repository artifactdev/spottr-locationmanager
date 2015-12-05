<div id="slide-out" class="side-nav fixed">
  <h3 class="center">Results</h3>
  <div class="input-field col s12">
        <select id="category-filter" class="icons">
          <option value="nothing" disabled selected><?php echo "$categoryFilter" ?></option>
          <option value="Industrie" ><?php echo "$industry" ?></option>
          <option value="Ruine" ><?php echo "$ruine" ?></option>
          <option value="Outdoor" ><?php echo "$outdoor" ?></option>
        </select>
        <label><?php echo "$filter" ?></label>
      </div>
      <div class="col s12 results"></div>
</div>