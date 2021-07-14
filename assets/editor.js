jQuery( document ).ready( function ($) {
   elementor.hooks.addAction( 'panel/open_editor/widget/archiv-item-block', function( panel, model, view ) { hide_tabs( panel.$el ); } );
   elementor.hooks.addAction( 'panel/open_editor/widget/archiv-text', function( panel, model, view ) { hide_tabs( panel.$el ); } );




   function hide_tabs( $el ) {
      $el.find( '.elementor-tab-control-advanced' ).on( 'click', function() {
         $( '#elementor-controls' ).hide();
         setTimeout(function() {
            $( '.elementor-control-section_effects' ).click();
            $( '.elementor-control-type-section:not(.elementor-control-section_effects)' ).remove();
            $( '#elementor-controls' ).show();
            $( '.elementor-control-section_effects' ).unbind( 'click' );
         }, 100 );
      });

   }

});
