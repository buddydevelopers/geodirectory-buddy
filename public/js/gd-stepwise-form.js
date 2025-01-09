jQuery(document).ready(function ($) {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $(
        ".geodir-bdsteps-main-container .geodir-bdsteps-container"
    ).length;
    var $ = jQuery;
    /**
     * Stepwise style of the plugin : default
     */
    let stepwise = () => {
        gsf_add_navigation();
        jQuery(".geodir-next-step").click(function () {
            var current_fs = jQuery(this).parent();
            if (
                jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .next(".geodir-bdsteps-container").length
            ) {
                setTimeout(function () {
                    window.dispatchEvent(new Event("resize"));
                }, 1000);
                jQuery("#buddy-gsf-progressbar li")
                    .eq(
                        jQuery(
                            "#geodirectory-add-post .geodir-bdsteps-container"
                        ).index(current_fs)
                    )
                    .removeClass("active")
                    .addClass("bd-completed");
                jQuery("#buddy-gsf-progressbar li")
                    .eq(
                        jQuery(
                            "#geodirectory-add-post .geodir-bdsteps-container"
                        ).index(current_fs.next())
                    )
                    .addClass("active");
                jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .next(".geodir-bdsteps-container")
                    .fadeIn();
                var next_step_id = jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .next(".geodir-bdsteps-container")
                    .attr("id");
                aui_cf_field_setup_rules($);
                jQuery("html, body").animate(
                    {
                        scrollTop: jQuery("#" + next_step_id).offset().top,
                    },
                    500
                );
            }
            return false;
        });
        jQuery(".geodir-prev-step").click(function () {
            if (
                jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .prev(".geodir-bdsteps-container").length
            ) {
                setTimeout(function () {
                    window.dispatchEvent(new Event("resize"));
                }, 1000);
                var current_fs = jQuery(this).parent();
                jQuery("#buddy-gsf-progressbar li")
                    .eq(
                        jQuery(
                            "#geodirectory-add-post .geodir-bdsteps-container"
                        ).index(current_fs)
                    )
                    .addClass("active")
                    .removeClass("bd-completed");
                jQuery("#buddy-gsf-progressbar li")
                    .eq(
                        jQuery(
                            "#geodirectory-add-post .geodir-bdsteps-container"
                        ).index(current_fs.prev())
                    )
                    .removeClass("active")
                    .addClass("bd-completed");
                //jQuery('#geodirectory-add-post').find('.geodir-bdsteps-container').fadeOut();
                jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .prev(".geodir-bdsteps-container")
                    .fadeIn();
                var prev_step_id = jQuery(this)
                    .parent(".geodir-bdsteps-container")
                    .prev(".geodir-bdsteps-container")
                    .attr("id");
                aui_cf_field_setup_rules($);
                jQuery("html, body").animate(
                    {
                        scrollTop: jQuery("#" + prev_step_id).offset().top,
                    },
                    500
                );
            }
            return false;
        });
    };

    let gsf_add_navigation = () => {
        jQuery("div.geodir-bdsteps-container:first")
            .show()
            .addClass("active-step");
        var total = jQuery(
            "#geodirectory-add-post .geodir-bdsteps-container"
        ).length;
        jQuery("#geodirectory-add-post .geodir-bdsteps-container").each(
            function (index) {
                var next_link_html =
                    '<a href="#" class="geodir-next-step geodir-form-step btn btn-primary">' +
                    buddysf.next_text +
                    "</a>";
                var prev_link_html =
                    '<a href="#" class="geodir-prev-step geodir-form-step btn btn-primary">' +
                    buddysf.prev_text +
                    "</a>";
                // if first step remove prev link
                if (index === 0) {
                    jQuery(this).append(next_link_html);
                } else if (index === total - 1) {
                    // if last step, remove next link
                    jQuery(this).append(prev_link_html);
                } else {
                    jQuery(this).append(prev_link_html);
                    jQuery(this).append(next_link_html);
                }
            }
        );
    };
   
    /* </fs_premium_only> */
    switch (buddysf.bd_stepwise_style) {
        case "stepwise":
            stepwise();
            break;
        default:
            stepwise();
        // call our default style i.e. stepwise form
    }
    
});
