$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (event) {
    var body =  $("#body").val();
    var title = $("input[name='title']").val();
    var type = $("input[name='type']").val();
    console.log(title);
    var modal = $(this);
    modal.find('#page-title').text('Title: ' + title);
    modal.find('#page-type').text("Type: " + type);
    modal.find('#content-body').html('Body: ' + nl2br(body));
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