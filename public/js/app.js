$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (event) {
    var body =  $("#body").val();
    var modal = $(this);
    modal.find('.content-body').html(nl2br(body));
    });
    
    function nl2br(el)
    {
        var lines = el.split(/\n/);
        var text = '';
        for (var i = 0 ; i < lines.length ; i++) {
           text += lines[i] + '<br>';
        }
        return text;
    }
});