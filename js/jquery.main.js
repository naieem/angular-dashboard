/*
 * jQuery v1.9.1 included
 */
$(document).ready(function() {
    $(".support_form").submit(function(event) {
        event.preventDefault();
        console.log('form submited');
        $(".return_msg").html("<img src='img/squares.gif'>");
        var dataf = new FormData($(this)[0]);
        // dataf.append('action', 'login_response');
        $.ajax({
            type: 'POST',
            url: "process.php",
            data: dataf,
            contentType: false,
            processData: false,
            success: function(response) {
                $(".return_msg").html(response);
            }
        });
    });
    $(".ticket").click(function(event) {
        event.preventDefault();
        $('#contact-form').popup('show');
    });
    $("#sign-up-cancel").click(function(event) {
        event.preventDefault();
        $('#contact-form').popup('hide');
    });
    $('#contact-form').popup();
    $('.search-box .search input[type="submit"]').val("");
    // $(".category-tree").prepend('<section class="category">' +
    //     '<h2><a href="#">Home</a></h2></section>');
    // toggle categories and sections on the home page
    // $(".cat").eq(0).addClass("active");
    // $(".category").on("click", function(e) {
    //     e.preventDefault();
    //     //alert("sdfds");
    //     var index = $(this).index();
    //     if (index != $(".cat.active").index()) {
    //         //alert(index);
    //         $(".cat.active").fadeOut("fast").removeClass("active");
    //         $(".cat").eq(index).fadeIn("slow").addClass("active");
    //     }
    //     //$(this).parent().nextAll().toggle();
    //     //return false;
    //     //$(this).next(".section").toggle("fast");
    // });
    // social share popups
    $(".share a").click(function(e) {
        e.preventDefault();
        window.open(this.href, "", "height = 500, width = 500");
    });
    // toggle the share dropdown in communities
    $(".share-label").on("click", function(e) {
        e.stopPropagation();
        var isSelected = this.getAttribute("aria-selected") == "true";
        this.setAttribute("aria-selected", !isSelected);
        $(".share-label").not(this).attr("aria-selected", "false");
    });
    $(document).on("click", function() {
        $(".share-label").attr("aria-selected", "false");
    });
    // show form controls when the textarea receives focus or backbutton is used and value exists
    var $commentContainerTextarea = $(".comment-container textarea"),
        $commentContainerFormControls = $(".comment-form-controls");
    $commentContainerTextarea.one("focus", function() {
        $commentContainerFormControls.show();
    });
    if ($commentContainerTextarea.val() !== "") {
        $commentContainerFormControls.show();
    }
    // Mark as solved button
    var $requestMarkAsSolvedButton = $(".request-comment-form .comment-container .mark-as-solved:not([data-disabled])"),
        $requestMarkAsSolvedCheckbox = $(".request-comment-form .comment-container input[type=checkbox]"),
        $requestCommentSubmitButton = $(".request-comment-form .comment-container input[type=submit]");
    $requestMarkAsSolvedButton.on("click", function() {
        $requestMarkAsSolvedCheckbox.attr("checked", true);
        $requestCommentSubmitButton.prop("disabled", true);
        $(this).attr("data-disabled", true).closest("form").submit();
    });
    // Change Mark as solved text according to whether comment is filled
    var $requestCommentTextarea = $(".request-comment-form .comment-container textarea");
    $requestCommentTextarea.on("keyup", function() {
        if ($requestCommentTextarea.val() !== "") {
            $requestMarkAsSolvedButton.text($requestMarkAsSolvedButton.data("solve-and-submit-translation"));
            $requestCommentSubmitButton.prop("disabled", false);
        } else {
            $requestMarkAsSolvedButton.text($requestMarkAsSolvedButton.data("solve-translation"));
            $requestCommentSubmitButton.prop("disabled", true);
        }
    });
    // Disable submit button if textarea is empty
    if ($requestCommentTextarea.val() === "") {
        $requestCommentSubmitButton.prop("disabled", true);
    }
    // Submit requests filter form in the request list page
    $("#request-status-select, #request-organization-select").on("change", function() {
        search();
    });
    // Submit requests filter form in the request list page
    $("#quick-search").on("keypress", function(e) {
        if (e.which === 13) {
            search();
        }
    });

    function search() {
        window.location.search = $.param({
            query: $("#quick-search").val(),
            status: $("#request-status-select").val(),
            organization_id: $("#request-organization-select").val()
        });
    }
    // Submit organization form in the request page
    $("#request-organization select").on("change", function() {
        this.form.submit();
    });
});