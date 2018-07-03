!function($) {

  // cache elements
  var $vcCategoriesMultipleOptionsField = $('#category_ids_select');
  var categoryIDs = $('input[name="category_ids"]').val();

  // setup multiple select boxes if JSON string can be parsed
  try {
    var ids = JSON.parse(decodeURIComponent(categoryIDs));
    for (var i = 0; i < ids.length; i++) {
      $vcCategoriesMultipleOptionsField.find('option[value="' + ids[i] + '"]').attr('selected', 'selected');
      $vcCategoriesMultipleOptionsField.trigger('chosen:updated');
    }
  } catch(e) {
    // nothing to do :)
  }

  // populate VC input field if selectbox changes
  $vcCategoriesMultipleOptionsField.change(function() {
    $('input[name="category_ids"]').val(encodeURIComponent(JSON.stringify($(this).val())));
  });

}(window.jQuery);