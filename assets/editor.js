jQuery( document ).ready( function ($) {

   elementor.hooks.addAction( 'panel/open_editor/widget', function( panel, model, view ) { 
      $( '#elementor-panel-inner').attr( 'element', model.attributes.widgetType );
   } );

});
