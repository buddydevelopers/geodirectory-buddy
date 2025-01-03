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
        setProgressBar(current);
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
                //jQuery('#geodirectory-add-post').find('.geodir-bdsteps-container').fadeOut();
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
                setProgressBar(++current);
                //	jQuery(this).parent('.geodir-bdsteps-container').find('.geodir-next-step').hide();
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
                setProgressBar(--current);
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
    /* <fs_premium_only> */
    let slider = (effect) => {
        gsf_add_navigation();
        setProgressBar(current);

        $(".geodir-next-step").click(function () {
            if (bd_check_validity(this)) {
                setTimeout(function () {
                    window.dispatchEvent(new Event("resize"));
                }, 1000);
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();
                jQuery("html, body").animate(
                    {
                        scrollTop: jQuery("#buddy-gsf-progressbar").offset()
                            .top,
                    },
                    10
                );
                //Add Class Active
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
                        ).index(next_fs)
                    )
                    .addClass("active");

                if ("slide" === effect) {
                    current_fs.hide();
                    next_fs.show();
                } else {
                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate(
                        { opacity: 0 },
                        {
                            step: function (now) {
                                // for making fielset appear animation
                                opacity = 1 - now;
                                console.log(opacity);
                                current_fs.css({
                                    display: "none",
                                    position: "relative",
                                });
                                next_fs.css({ opacity: opacity });
                            },
                            duration: 500,
                        }
                    );
                }
                aui_cf_field_setup_rules($);
                setProgressBar(++current);
            }
            return false;
        });

        $(".geodir-prev-step").click(function () {
            // if( bd_check_validity() ){
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            setTimeout(function () {
                window.dispatchEvent(new Event("resize"));
            }, 1000);
            //Remove class active
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
                    ).index(previous_fs)
                )
                .removeClass("bd-completed")
                .addClass("active");
            jQuery("html, body").animate(
                {
                    scrollTop: jQuery("#buddy-gsf-progressbar").offset().top,
                },
                10
            );
            if ("slide" === effect) {
                previous_fs.show();
                current_fs.hide();
            } else {
                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate(
                    { opacity: 0 },
                    {
                        step: function (now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                display: "none",
                                position: "relative",
                            });
                            previous_fs.css({ opacity: opacity });
                        },
                        duration: 500,
                    }
                );
            }
            // aui_cf_field_setup_rules($);
            setProgressBar(--current);
            // }
            return false;
        });
    };
    /* </fs_premium_only> */
    switch (buddysf.bd_stepwise_style) {
        case "slide":
            /* <fs_premium_only> */
            slider("slide");
            /* </fs_premium_only> */
            break;
        case "fade":
            /* <fs_premium_only> */
            slider("fade");
            /* </fs_premium_only> */
            break;
        default:
            stepwise();
        // call our default style i.e. stepwise form
    }

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }
    /* <fs_premium_only> */
    /**
     * Check required field validation for each slide.
     * return true if valid.
     */
    let bd_check_validity = (handle) => {
        let validate_elements = jQuery("input,textarea,select").filter(
            "[required]:visible"
        );
        let validation_check = true;
        if (validate_elements.length >= 0) {
            jQuery.each(validate_elements, function (i, val) {
                if (!jQuery(val)[0].checkValidity()) {
                    jQuery(val)[0].reportValidity();
                    validation_check = false;
                    return false;
                }
            });
        }
        return validation_check;
    };
    jQuery("#geodir-add-listing-submit button").click(function () {
        if (!jQuery("#geodirectory-add-post")[0].checkValidity()) {
            jQuery(".geodir-bdsteps-main-container .geodir-bdsteps-container")
                .css("opacity", "1")
                .slideDown();
            jQuery(".geodir-bdsteps-main-container").addClass("gsf-full-form");
        }
    });

    // Function to initialize step navigation
    function initializeStepNavigation() {
        // Use event delegation to listen for click events on dynamically added .bd-completed elements
        jQuery("#buddy-gsf-progressbar").on(
            "click",
            ".bd-completed, .next-item",
            function () {
                // Get the data-filter value from the clicked <li>
                const filter = jQuery(this).data("filter");
                const isNextItem = jQuery(this).hasClass("next-item");

                if (isNextItem) {
                    // If the clicked item is a next-item, make it active and show its content
                    jQuery("#buddy-gsf-progressbar li").removeClass("active");
                    jQuery(this).addClass("active");

                    const correspondingContainer = jQuery(
                        `.geodir-bdsteps-container[data-filterdiv='${filter}']`
                    );
                    if (correspondingContainer.length) {
                        jQuery(".geodir-bdsteps-container")
                            .hide()
                            .css("opacity", ""); // Hide all containers
                        correspondingContainer.show().css("opacity", "1"); // Show the selected container
                    } else {
                        console.warn(`No container found for filter ${filter}`);
                    }
                } else if (filter) {
                    // Standard behavior for .bd-completed elements
                    jQuery("#buddy-gsf-progressbar .bd-completed").removeClass(
                        "active"
                    );
                    jQuery("#buddy-gsf-progressbar li").each(function () {
                        if (!jQuery(this).hasClass("bd-completed")) {
                            jQuery(this).removeClass("active");
                        }
                    });
                    jQuery(this).addClass("active");

                    // Toggle the display of the corresponding .geodir-bdsteps-container div
                    const correspondingContainer = jQuery(
                        `.geodir-bdsteps-container[data-filterdiv='${filter}']`
                    );
                    if (correspondingContainer.length) {
                        jQuery(".geodir-bdsteps-container")
                            .hide()
                            .css("opacity", ""); // Hide all containers
                        correspondingContainer.show().css("opacity", "1"); // Show the selected container
                    } else {
                        console.warn(`No container found for filter ${filter}`);
                    }
                } else {
                    console.warn(
                        "No data-filter attribute found on this <li>."
                    );
                }
                // Enable click on the next <li> after the last .bd-completed
                const nextItem = jQuery("li.bd-completed").last().next();
                if (nextItem.length) {
                    nextItem.addClass("next-item"); // Mark the next item for special handling
                }
            }
        );


    }

    // Initialize step navigation when the DOM is ready
    initializeStepNavigation();
    /* </fs_premium_only> */
});
