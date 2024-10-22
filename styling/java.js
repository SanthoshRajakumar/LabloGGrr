function parallax_height() {
    var scroll_top = $(this).scrollTop();
    var sample_section_top = $(".sample-section").offset().top;
    var header_height = $(".sample-header-section").outerHeight();
    $(".sample-section").css({ "margin-top": header_height });
    $(".sample-header").css({ height: header_height - scroll_top });
  }
  parallax_height();
  $(window).scroll(function() {
    parallax_height();
  });
  $(window).resize(function() {
    parallax_height();
  });

  $(document).ready(function() {
    // Function to generate a key for storing scroll position based on the current path
    function generateStorageKey() {
        return 'scrollPosition_' + window.location.pathname;
    }

    // Save the scroll position before navigating away from the page
    $(window).on('beforeunload', function() {
        localStorage.setItem(generateStorageKey(), window.scrollY);
    });

    // Restore the scroll position when the page is loaded, if there's a stored value
    $(window).on('load', function() {
        var storedPosition = localStorage.getItem(generateStorageKey());
        if (storedPosition) {
            window.scrollTo(0, parseInt(storedPosition));
        }
    });
});
