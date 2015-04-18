<div class="search-bar horizontal">
    <form class="main-search border-less-inputs" role="form" method="post">
        <div class="input-row">
            <div class="form-group">
                <input type="text" class="form-control" id="keyword" placeholder="Enter Keyword">
            </div>
            <div class="form-group category-filter">
                <select name="category" id="category-filter" title="Select Category" data-live-search="true">
                    <option value="industrie">Industrie</option>
                    <option value="ruine">Ruine</option>
                    <option value="outdoor">Outdoor</option>
                </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <button type="submit" id="category-filter-search" class="btn btn-default"><i class="fa fa-search"></i></button>
                <a href="#" id="reset-filter" class="btn btn-default"><i class="fa fa-minus-circle"></i></a>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.input-row -->
    </form>
    <!-- /.main-search -->
</div>