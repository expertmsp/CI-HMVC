<?php 

/*
Template Name: Directory
*/

get_header();

?>
<img src="<?php echo get_bloginfo('template_directory');?>/img/slider/hero3.jpg" class="hero">
  <div id="directory" class="container">
    <h1>Directory</h1>
    <p><strong>Lorem ipsum dolor sit amet, falli pertinacia ut per, ex est vivendo repudiandae, est alii eros adolescens at. Vide ponderum qui ea, te est diceret propriae.</strong></p>
    <p>
    Id oratio putant mei. Labore nostrud nusquam ea eos, accusam appetere indoctum an quo, ne duis noster virtute nec. Ea ferri aeterno eum, dictas docendi moderatius vix ex. Munere phaedrum ut nam, vis dicit feugait no. Ex quodsi mentitum conclusionemque usu, nisl delenit intellegebat vel ut.
    </p>
      <div class="input-group input-group-justified input-mcsearch" style="width:100%">
        <div class="input-group-btn sort-select" style="width:50%">
         <button type="button" style="width:50%" class="btn active" id="latest">Latest</button>
         <button type="button" style="width:50%" class="btn asc" id="sort">A-Z</button>
        </div>
        <input type="text" id="filter" class="form-control" placeholder="&#xF002;&nbsp; Search By Keyword" style="font-family:proxima-nova, FontAwesome; color:#c8c8c8">
      </div>
      
      <div id="directory-listings">
        <i class="fa fa-circle-o-notch fa-spin loading"></i>
      </div>
  
  
<?php  get_footer(); ?>