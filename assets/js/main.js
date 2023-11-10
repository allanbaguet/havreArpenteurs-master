$(document).ready(function() {
  $.trumbowyg.svgPath = '/assets/img/icons.svg';
  // Le textarea des commentaires permettra moins de mis en page
  $('.textareaComment').trumbowyg({
    lang: 'fr',
    semantic: false,
    btns: [
        // ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        // ['formatting'],
        ['strong', 'em','underline'],
        ['superscript', 'subscript'],
        ['link'],
        // ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        // ['horizontalRule'],
        // ['removeformat'],
        ['fullscreen']
    ]
  });
  $('textarea').trumbowyg({
    lang: 'fr',
    semantic: false,
    btns: [
      // ['viewHTML'],
      ['undo', 'redo'], // Only supported in Blink browsers
      ['formatting'],
      ['strong', 'em','underline'],
      ['superscript', 'subscript'],
      ['link'],
      ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
      ['unorderedList', 'orderedList'],
      ['horizontalRule'],
      ['removeformat'],
      ['fullscreen']
    ]
  });

  setTimeout(function(){
    $('#snackbar').hide();
  }, 6500);

  // $('.question').on('click', function(){
  //   $(this).children('p').toggle(250);
  //   $(this).children('ul').toggle(250);
  //   $(this).children('li').toggle(250);
  // });
});
