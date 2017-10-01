var readMore = {
    options : null,
    init: function(options){
        readMore.options = options;

        // set device option value
        readMore.setDeviceOption();
        //initialize the setup
        readMore.setup();

        readMore.click();
        //readMore.listenForMinimize();
        //readMore.listenForExpand();
    },
    click: function(){
        $(readMore.options.element + " .more-less").click(function(event){
            event.preventDefault();

            // check the class
            if($(this).hasClass("read")){
                // expand
                readMore.expand($(this).parent());
            } else if($(this).hasClass("read-less")){
                readMore.minimize($(this).parent());
            }
        });
    },
    setup: function(){
        // we need to pull any matching elements
        if($(readMore.options.element).length) {
            $.each($(readMore.options.element), function(index, el){
                // pull height of element

                // fix this
                var height = $(el).parent().innerHeight();
                $(el).data('height', height);

                // if the height is more than 300 we have to add some css
                if(height > 300) {
                    readMore.insertReadMore(el);
                }
            });
        }
    },
    setDeviceOption: function(){
        // get the document width
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            // You are in mobile browser
            readMore.options.deviceType = 'mobile';
        } else {
            readMore.options.deviceType = 'desktop';
        }
    },
    insertReadMore: function(el){
        if(jQuery.inArray(readMore.options.deviceType, readMore.options.devices) > -1) {
            readMore.minimize(el);
            $(el).append("<div class='more-less read'>Read More</div>");
        }
    },
    minimize: function(el){
        $(el).css("overflow", "hidden").css("min-height", readMore.options.height);

        $(el).animate({'max-height': readMore.options.height}, "slow");

        // swap text
        // swap the text & remove class
        var lessDiv = $(el).find(".read-less");
        $(lessDiv).removeClass('read-less').addClass('read');
        $(lessDiv).text("Read More");
    },
    expand: function(el){
        var minHeight = $(el).data('height') + $(".section-content .read").innerHeight();

        $(el).animate({'min-height' : minHeight}, "slow", function(){
            // remove styles to give it the effect
            $(el).css("overflow", "none").css('max-height', "none");
        });

        // swap the text & remove class
        var readDiv = $(el).find(".read");
        $(readDiv).removeClass('read').addClass('read-less');
        $(readDiv).text("Read Less");
    },
};
$(document).ready(function(){
    // pass object with options.
    // element, height
    // device ('mobile', 'all')
    readMore.init({'element': '.section-content','height': 300, 'devices': ['mobile']});

    $('#myModal').on('show.bs.modal', function (event) {
    var body =  $("#body").val();
    var title = $("input[name='title']").val();
    var type = $("input[name='type']").val();
    var modal = $(this);
    modal.find('#page-title').text('Title: ' + title);
    modal.find('#page-type').text("Type: " + type);
    modal.find('#content-body').html('Body: ' + nl2br(body));
    });
    
    function nl2br(content)
    {   
        var lines = content.split(/\n/);
        var text = '';
        for (var i = 0 ; i < lines.length ; i++) {
           text += lines[i] + '<br>';
        }
        return text;
    }
});