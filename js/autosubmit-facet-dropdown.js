/**
 * @file
 * Immediately submit dropdown facets when one is selected. Hide the submit button.
 */

(function ($) {

  "use strict";

  Drupal.behaviors.autosubmitFacetDropdown = {
    attach: function (context, settings) {
      _.each(Object.keys(settings.facets.autosubmitdropdown), function(el, idx, list) {
        var $select = $('.' + el + ' select');
        var $submit = $select.closest('form').find('input[type=submit]');
        $submit.hide();
        $select.on('change', function() {
          $submit.click();
        });
      });
    }
  };

})(jQuery);
