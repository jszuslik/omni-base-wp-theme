( function( $, api ) {

    /* === Section Manager Control === */

    api.controlConstructor['section-manager'] = api.Control.extend( {
        ready: function() {
            var control = this;

            $( 'input:checkbox', control.container ).change(
                function() {
                    // Get all of the checkbox values.
                    var checkbox_values = $( 'input[type="checkbox"]:checked', control.container ).map(
                        function() {
                            return this.value;
                        }
                    ).get();
                    console.log(checkbox_values);
                    // Set the value.
                    if ( null === checkbox_values ) {
                        control.setting.set( '' );
                    } else {
                        control.setting.set( checkbox_values );
                    }
                }
            );

            $( '.section-list', control.container ).sortable({
                update: function( event, ui ){

                    // Get all of the checkbox values.
                    var checkbox_values = $( 'input[type="checkbox"]:checked', control.container ).map(
                        function(i) {
                            menu_order = i + 1;
                            post_id = jQuery(this).attr("data-post_id");
                            console.log(menu_order);
                            $.ajax({
                                url: omni_update_menu_order.ajax_url,
                                type: 'post',
                                data : {
                                    action: 'omni_wp_theme_ajax_update_post_menu_order',
                                    post_id: post_id,
                                    menu_order: menu_order
                                },
                                success: function (response) {
                                    console.log(response);
                                }
                            });
                            return this.value;
                        }
                    ).get();

                    console.log(checkbox_values);
                    // Set the value.
                    if ( null === checkbox_values ) {
                        control.setting.set( '' );
                    } else {
                        control.setting.set( checkbox_values );
                    }
                }
            }).disableSelection();
        }
    } );

    /* === Dropdown Taxonomies Control === */
    api.controlConstructor['dropdown-taxonomies'] = api.Control.extend( {
        ready: function() {
            var control = this;

            $( 'select', control.container ).change(
                function() {
                    control.setting.set( $( this ).val() );
                }
            );
        }
    } );

    /* === Dropdown Sidebars Control === */
    api.controlConstructor['dropdown-sidebars'] = api.Control.extend( {
        ready: function() {
            var control = this;

            $( 'select', control.container ).change(
                function() {
                    control.setting.set( $( this ).val() );
                }
            );
        }
    } );

    /* === Homepage Section Background Control === */
    api.controlConstructor['hp-section-bg-select'] = api.Control.extend( {
        ready: function() {
            var control =  this;

            $( 'select', control.container ).change(
                function() {
                    control.setting.set( $(this).val() );
                }
            );
        }
    } );

    /* === Header Padding Control == */
    api.controlConstructor['header-padding'] = api.Control.extend( {
        ready: function() {
            var control = this;

            $('input', control.container ).change(
                function() {
                    control.setting.set( $(this).val() );
                }
            );
        }
    });

} )( jQuery, wp.customize );
