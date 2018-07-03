!function($) {

  function setSortString() {
    var sort = {};

    $('.contentorder').find('.sortable li').each(function(i) {
      sort[i] = $(this).find('input').data('contentorder');
    });

    $('#contentorder-input').val(encodeURIComponent(JSON.stringify(sort)));
  }

  // set sort string initially
  setSortString();

  // cache elements
  var $vcInputField = $('.wpb_el_type_hiddencontentorderinput');

  // init sortable function
  $('.sortable').sortable({
    stop: function() {
      setSortString();
    }
  });

  // setup checkboxes & selectboxes
  $vcInputField.each(function() {
    var $input = $(this).find('input, select');
    var name = $input.attr('name');

    var $el = $('[data-contentorder="' + name + '"]');
    var t = $el.get(0).tagName;

    if (t == 'INPUT') {
      $el.prop('checked', parseInt($input.val()));
    } else if (t == 'SELECT') {
      $el.find('option').removeAttr('selected');
      $el.find('option[value="' + $input.val() + '"]').attr('selected', 'selected');
    }

  });

  // populate VC input field if checkbox changes
  $('.contentorder-show').change(function() {
    var $originalInput = $vcInputField.find('[name="' + $(this).data('contentorder') + '"]');

    if ($(this).is(':checked')) {
      $originalInput.val('1');
    } else {
      $originalInput.val('0');
    }
  });

  // populate VC input field if selectbox changes
  $('.contentorder-layout').change(function() {
    $vcInputField.find('[name="' + $(this).data('contentorder') + '"]').val($(this).val());
  });

}(window.jQuery);