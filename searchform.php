<form class="navbar-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group jeff-search-bar"> <!-- col-xs-12 col-sm-3 pull-right -->
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-search"></span>
        </span>
        <input type="text" class="form-control" placeholder="search&hellip;"  value="<?php echo get_search_query() ?>" name="s" title="Search" >
    </div>
</form>
