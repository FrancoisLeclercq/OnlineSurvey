function showPiechart(id) {
    var showid = `#show-dataviz${id}`;
    var closeid = `#close-dataviz${id}`;
    if($('#my_dataviz'+id).css('display') === 'none') {
        document.getElementById('show-dataviz'+id).style.cursor = 'pointer';
        $(document).on('click', showid, function(){
          $(showid).css('display', 'none');
          $(closeid).css('display', 'block');
          $('#my_dataviz'+id).css('display', 'block');
        });
    }
    if($('#full_text_dataviz'+id).css('display') === 'none') {
        document.getElementById('show-dataviz'+id).style.cursor = 'pointer';
        $(document).on('click', showid, function(){
          $(showid).css('display', 'none');
          $(closeid).css('display', 'block');
          $('#full_text_dataviz'+id).css('display', 'block');
        });
    }
    document.getElementById('close-dataviz'+id).style.cursor = 'pointer';
    $(document).on('click', closeid, function(){
      $(closeid).css('display', 'none');
      $(showid).css('display', 'block');
      $('#my_dataviz'+id).css('display', 'none');
      $('#full_text_dataviz'+id).css('display', 'none');
    });
}