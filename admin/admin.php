<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




add_action('admin_menu', 'archiv_plugin_settings');
function archiv_plugin_settings(){
   add_menu_page(
      'Theme page title', // page title 
      'Archiv Settings', // menu title
      'manage_options', // capability
      'archiv-options', // menu-slug
      'archiv_settings_page' // function that will render its output
   );
   add_submenu_page( 
      'archiv-options', // parent slug
      'Archiv Settings', // page title
      'Settings', // menu title
      'manage_options', // capability
      'archiv-options', // slug
      'archiv_settings_page' // callback
   );
   // add_submenu_page( 
   //    'archiv-options', // parent slug
   //    'Widgets settings', // page title
   //    'Widgets', // menu title
   //    'manage_options', // capability
   //    'archiv-widgets', // slug
   //    'archiv_widgets_settings' // callback
   // );



}

  




add_action( 'admin_init', 'register_archiv_settings' );
function register_archiv_settings() {
   register_setting( 'archiv-settings-group', 'archiv_item_block_template' );
}

function archiv_settings_page() {
?>
<div class="wrap">
   <h1><?php echo __( 'Archiv Widgets Settings','archiv-widgets' ) ?></h1>

      <div class="archiv-cards-wrapper">

      <div class="card">
         <form method="post" action="options.php">
            <?php settings_fields( 'archiv-settings-group' ); ?>
            <?php do_settings_sections( 'archiv-settings-group' ); ?>
            <table class="form-table">


               <!-- ITEM BLOCK TEMPLATE ID -->
               <tr valign="top">
                  <th scope="row">Item Block Template ID</th>
                  <td>
                     <input id="archiv-item-block-template" type="text" name="archiv_item_block_template" value="<?php echo esc_attr( get_option( 'archiv_item_block_template' ) ); ?>" style="width: 100%;" autocomplete="off" />
                  </td>
               </tr>



            </table>    


            
            <?php submit_button(); ?>

         </form>
      </div>




   </div><!-- archiv-cards-wrapper -->

</div>
<?php }


// function archiv_widgets_settings(){
//    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
//    <h2>Settings</h2></div>';
// }