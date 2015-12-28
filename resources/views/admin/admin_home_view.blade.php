@extends('layouts.admin')
@section('title','Admin')
@section('content')
<div class='container'>
    <div class='container'>
        <h3>Admin Panel</h3>

        <div class='row-group'>
            <span>The admin section of the site allow you to modify and edit many pages.</span>

            <p>You can ..</p>
            <ul>
                <li>Edit the About page.</li>
                <li>Edit the Projects page.</li>
                <li>Edit the Downloads page.</li>
            </ul>

            <p>
                Clicking any of the links on the navigation will take you to that particular
                edit page. We tried to make your life as easy as we could with making most of the 
                columns in the database table editable so you can create new content or update
                any content.
            </p>
            
            <p>
                When editing pages if you want to include styling to sections make sure
                to include style tags. For example
                <code>
                    style='font-weight: bold'
                </code>
            </p>
            
            <p>
                A few things to consider, when we output the body sections of the pages we use laravels
                <code>nl2br</code> function. So if creating tables like we have in the
                downloads page. Make sure to not create the tables with each tr or td on a newline.
            </p>
        </div>
    </div>
</div>
@endsection

