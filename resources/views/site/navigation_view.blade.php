<div class='container'>
    <div class="pull-right">
        <a class="new-co" href="{{ URL::route('login') }}"><span>Login</span></a>
    </div>
</div>
<div class="container hidden-xs">
    <a href="{{ URL::route('site.home') }}"><div class="header"></div></a>
</div>
<div class="main-nav">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-inverse navigation">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="{{ URL::route('site.home') }}">Projects By Miguel</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav nav-justified">
                    <li class="active item-margin"><a class="new-co" href="#">About <span class="sr-only">(current)</span></a></li>
                    <li class='item-margin'><a class="new-co" href="#">Projects</a></li>
                    <li class='item-margin'><a class='new-co' href="#">Downloads</a></li>
                    <li class='item-margin'><a class='new-co' href="#">Contact</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        </div>
    </div>
</div>