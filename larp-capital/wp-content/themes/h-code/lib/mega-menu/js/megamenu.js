!function($) {
	"use strict";

    /* For Mega Menu*/
  $( document ).ready(function() {
      
    // show or hide megamenu fields on parent and child list items
    hcode_menu_item_mouseup_event();
    hcode_megamenu_status_update();
    hcode_update_megamenu_field_classes();
    
    /* On mouseup event check megamenu status and add class or remove class */
    function hcode_menu_item_mouseup_event(){
        $( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
            if( ! $( event.target ).is( 'a' )) {
                setTimeout( hcode_update_megamenu_field_classes, 300 );
            }
        });
    }
      
    /* Check if Mega Menu is enable for parent */
    function hcode_megamenu_status_update(){
        $( document ).on( 'click', '.edit-menu-item-hcode-mega-menu-item-status', function() {
          
            var parent_li_item = $( this ).parents( 'li.menu-item:eq( 0 )' );

            if( $( this ).is( ':checked' ) ) {
                parent_li_item.addClass( 'hcode-megamenu-active' );
            } else 	{
                parent_li_item.removeClass( 'hcode-megamenu-active' );
            }
            hcode_update_megamenu_field_classes();
        });
    }
    
    /* Check onload which menu is checked and add class "hcode-megamenu-active" */
    function hcode_update_megamenu_field_classes(){
        var hcode_menu_li_items = $( '.menu-item');
        
        hcode_menu_li_items.each( function( i ) 	{
            var hcode_megamenu_status = $( '.edit-menu-item-hcode-mega-menu-item-status', this );
            
            if( ! $( this ).is( '.menu-item-depth-0' ) ) {
                var check_item = hcode_menu_li_items.filter( ':eq(' + (i-1) + ')' );

                if( check_item.is( '.hcode-megamenu-active' ) ) {
                    hcode_megamenu_status.attr( 'checked', 'checked' );
                    $( this ).addClass( 'hcode-megamenu-active' );
                } else {
                    hcode_megamenu_status.attr( 'checked', '' );
                    $( this ).removeClass( 'hcode-megamenu-active' );
                }
            } else {
                if( hcode_megamenu_status.attr( 'checked' ) ) {
                        $( this ).addClass( 'hcode-megamenu-active' );
                }
            }
        });
    }
    
      var counter = 1;
      $( "#menu-to-edit .js-source-states" ).each(function( index ) {
        var statesOptions = $(this).html();
        $(this).parent().find(".js-states").append(statesOptions);
        $(this).remove();
        counter++;
      });

      function formatState (state) {
          if (!state.id) {
            return state.text;
          }
          var $state = $(
        '<span>' +
          '<i class="'+state.element.value.toLowerCase()+'"></i>' +
          state.text +
        '</span>'
      );
        return $state;
      };

      $(".js-example-templating").select2({
        templateResult: formatState,
        templateSelection: formatState
      });
      
      /* H-Code Licence - START CODE */
      $( '.hcode-licence' ).on( 'click', function(e) {
          e.preventDefault();

          if( $( this ).attr( 'disabled' ) ){
              return false;
          }

          var currentVar = $(this);
          currentVar.parent().find( 'img' ).css("display","inline-block");
          var data = {
              action: 'hcode_active_theme_licence',
          };

          var request = $.getJSON({
              url: ajaxurl,
              type: "POST",
              data: data
          });
          request.success(function(response) {
              response && response.status ? window.location = response.url : alert( hcode_licence_messages.response_failed );
          });

          request.fail(function(jqXHR, textStatus) {
              alert( 'Request failed: ' + textStatus );
          });

      });

      /* H-Code Licence - END CODE */
      
      /* Hide Licence Activation Message Cookie - START CODE */

      var HcodeSetCookie = function ( c_name, value, exdays ) {
        var exdate = new Date();
        exdate.setDate( exdate.getDate() + exdays );
        var c_value = encodeURIComponent( value ) + ((null === exdays) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = c_name + "=" + c_value;
      };
      $( document ).on( 'click', '.hcode-license-activation-message .notice-dismiss', function( event ) {
        event.preventDefault();
        HcodeSetCookie( 'hcode_hide_activation_message', 'hide', 30 );
      } );

      /* Hide Licence Activation Message Cookie - END CODE */
  });
    
  $( document ).ajaxComplete(function() {
    var $states = $(".js-source-states");
    var statesOptions = $states.html();
    $states.remove();

    $(".js-states").append(statesOptions);

    function formatState (state) {
        if (!state.id) {
          return state.text;
        }
        var $state = $(
      '<span>' +
        '<i class="'+state.element.value.toLowerCase()+'"></i>' +
        state.text +
      '</span>'
    );
      return $state;
    };

    $(".js-example-templating").select2({
      templateResult: formatState,
      templateSelection: formatState
    });
  });
    
}(window.jQuery);