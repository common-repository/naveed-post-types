jQuery(document).ready(function () {
    var slug_field, slug, slug_alert, post_type, post_type_field;
    post_type_field = jQuery('input[name="post_type"]');
    slug_field = jQuery('input[name="slug"]');
    slug_alert = jQuery('#slug-alert');
    slug_field.on('keyup', function (e) {
        slug = jQuery(slug_field).val().replace(/[^a-zA-Z0-9 ,._-\s]/g, '').split(',').join('-').split('.').join('-').split(' ').join('-').toLowerCase().replace(/(-)\1+/g, '$1');
        slug_field.val(slug);
        post_type = post_type_field.val();
        e.preventDefault();
        jQuery.ajax({
            data: {
                action: 'npt_slug_validation',
                slug: slug,
                post_type: post_type,
                nonce: NPT_Ajax.nonce
            },
            type: 'post',
            url: NPT_Ajax.ajaxurl,
            dataType: 'json',
            success: function (response) {
                if (response.type === 'error') {
                    slug_alert.addClass('alert-danger');
                    slug_alert.html(response.text);
                    jQuery('#publish').attr('disabled', 'disabled');
                }
                if (response.type === 'success') {
                    slug_alert.removeClass('alert-danger');
                    slug_alert.html(response.text);
                    jQuery('#publish').removeAttr('disabled');
                }
            },
            error: function () {
            }
        });
    });
});

jQuery(document).ready(function () {
    jQuery('.icon-field').focus(function (e) {
        e.preventDefault();
        var icon = jQuery(this).val();
        jQuery.ajax({
            data: {
                action: 'npt_icon_script', icon: icon, nonce: NPT_Ajax.nonce
            }, type: 'post', url: NPT_Ajax.ajaxurl, dataType: 'json', success: function (response) {
                if (response.type === 'data') {
                    jQuery('#icon-url').html(response.icon);
                }
            }, error: function () {
            }
        });
    });
    jQuery( '.button-text' ).click(function (e) {
        e.preventDefault();
        jQuery(this).text(function (i, text) {
            if (text === 'Change Icon') {
                return 'Set Icon';
            }
            if (text === 'Select Icon') {
                return 'Set Icon';
            }
            if (text === 'Set Icon') {
                return 'Change Icon';
            }
        })
        jQuery('.section-icon').animate({
            height: 'toggle'
        }, 300, function() {
            // Animation complete.
        });
    });
});


jQuery(document).ready(function () {
    jQuery('#auto-populate').on('click tap', function (e) {
        e.preventDefault();
        var append;
        const str = undefined;
        var slug = jQuery('input[name="slug"]').val();
        var singular_name = jQuery('input[name="singular-name"]').val();
        var name = jQuery('input[name="name"]').val();
        var plural_slug = name.toLowerCase();
        var fields = jQuery('#field-labels input[type="text"]');
        jQuery(fields).each(function (i, val) {
            var newval = jQuery(val).data('label');
            var field = jQuery(val).data('field');
            if (str !== newval) {
                // "slug" is our placeholder from the labels.
                if ('name' === field) {
                    append = (str ?? newval).replace(/item/gi, name);
                } else if ('slug' === field) {
                    append = (str ?? newval).replace(/item/gi, slug);
                } else if ('singular-name' === field) {
                    append = (str ?? newval).replace(/item/gi, singular_name);
                } else {
                    append = (str ?? newval).replace(/item/gi, plural_slug);
                }
                if (jQuery(val).val() === '') {
                    jQuery(val).val(append);
                }
            }
        });
    });
    jQuery('#auto-clear').on('click tap', function (e) {
        e.preventDefault();
        var fields = jQuery('#field-labels input[type="text"]');
        jQuery(fields).each(function (i, val) {
            jQuery(val).val('');
        });
    });
});

jQuery(document).ready(function () {
// Automatically toggle the "page attributes" checkbox if post type is hierarchical.
    jQuery('#field-arguments #hierarchical').on('change', function (e) {
        e.preventDefault();
        var hierarchical = jQuery(this).val();
        if ('1' === hierarchical) {
            jQuery('#page-attributes').prop('checked', true);
        } else {
            jQuery('#page-attributes').prop('checked', false);
        }
    });
});