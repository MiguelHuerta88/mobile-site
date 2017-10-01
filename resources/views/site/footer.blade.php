<div class="ad-slot-728-90">FOOTER AD SLOT</div>
<div class="footer-div">
    <div class='container footer'>
        <div class='row col-lg-offset-10 col-md-offset-9 col-sm-offset-8 col-xs-offset-3'>
            {{--<a href="#" class="pull-left"><div class='icon-fb'></div></a>
            <a href="#" class="pull-left"><div class="icon-link"></div></a>
            <a href="#" class="pull-left"><div class="icon-google"></div></a>
            <a href="#" class="pull-left"><div class="icon-git"></div></a>--}}
            @foreach($links as $link)
                <a href="{{ $link->url }}" class="pull-left"><div class="icon-{{$link->title}}"></div></a>
            @endforeach
        </div>
        <div class="row pad-10">
            <div class="container">
                <span class="glyphicon glyphicon-phone icon-phone"><a href="tel:3103676337"> 310.367.6337</a></span>
                <span class="glyphicon glyphicon-envelope icon-envelope"><a href="mailto:guelme88@gmail.com"> guelme88@gmail.com</a></span>
            </div>
        </div>
        <div class='row pad-10'>
            <div class='container'>
                <span class="footer-text">Copyright&copy; {{ date('Y') }} Miguel Huerta.</span>
            </div>
        </div>
    </div>
</div>
