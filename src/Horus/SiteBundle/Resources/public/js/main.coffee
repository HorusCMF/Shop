$ ->
  $('.multiselect').multiselect
    buttonText: (options, select) ->
      if options.length is 0
        "Aucune"
      else
        selected = ""
        options.each ->
          selected += $(this).text() + ", "
        selected.substr(0, selected.length - 2) + " <b class=\"caret\"></b>"
    maxHeight: 200
    maxWidth: 200
    buttonWidth: 200
    enableFiltering: true
    enableCaseInsensitiveFiltering : true

  $( ".date" ).datepicker()

  $('.alert-success').delay(5000).slideUp('fast')

  $('#moresearch').click ->
    $('#advancedsearch').toggleClass('hide','')

  $('#closepanel').click ->
    $('.row-fluid .span9').toggleClass('span9','span12')

  $('.check, .rad').iCheck
    checkboxClass: 'icheckbox_flat-green'
    radioClass: 'iradio_flat-green'
    increaseArea: '20%'

  $('form').on "submit", (event) ->
    $(this).find('button[type=submit]').attr 'disabled','disabled'
    $(this).find('button[type=submit]').text('Envoi en cours...')
    $('#overlay').removeClass('hide')

  $(window).scroll ->
    if $(this).scrollTop() > 100
      $(".scrollup").fadeIn()
    else
      $(".scrollup").fadeOut()

  $(".scrollup").click ->
    $("html, body").animate
      scrollTop: 0
    , 600
    false