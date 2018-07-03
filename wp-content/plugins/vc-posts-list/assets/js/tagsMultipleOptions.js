!function($) {

  // cache elements
  var $vcTagsMultipleOptionsField = $('#tag_ids_select');
  var tagIDs = $('input[name="tag_ids"]').val();

  // setup multiple select boxes
  try {
    var ids = JSON.parse(decodeURIComponent(tagIDs));
    for (var i = 0; i < ids.length; i++) {
      $vcTagsMultipleOptionsField.find('option[value="' + ids[i] + '"]').attr('selected', 'selected');
      $vcTagsMultipleOptionsField.trigger('chosen:updated');
    }
  } catch(e) {
    // nothing to do :)
  }

  // populate VC input field if selectbox changes
  $vcTagsMultipleOptionsField.change(function() {
    $('input[name="tag_ids"]').val(encodeURIComponent(JSON.stringify($(this).val())));
  });

}(window.jQuery);