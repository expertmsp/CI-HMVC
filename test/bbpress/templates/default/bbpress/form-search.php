<?php
/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */
?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
    <input placeholder="Search by Keyword" tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr(bbp_get_search_terms()); ?>" name="bbp_search" id="bbp_search" />
    <button id="search_button" class="SubmitBtn">Submit</button>
</form>
