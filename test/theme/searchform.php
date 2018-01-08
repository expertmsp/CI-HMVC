<form class="form-search form-horizontal pull-right animated fadeIn" role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div class="input-append span12">
        <input type="text" class="search-query" placeholder="Search" name="s" id="s" autocomplete="off" onfocus="if (this.placeholder == 'Search') {this.placeholder = '';}" onblur="if (this.placeholder == '') {this.placeholder = 'Search';}">
        <button type="submit" class="btn btn-s"><i class="icon-p4p-search"></i></button>
        <button type="button" class="btn btn-c" id="closeNavSearch"><i class="fa fa-close"></i></button>
    </div>
</form>