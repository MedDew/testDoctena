@extends("layouts.app")


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User Dashboard</div>

                    <div class="panel-body">
                        Welcome {{ $user->firstname }} {{ $user->lastname }}... You are logged in!
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Book added</h3>
            </div>
            <div class="panel-body">
                <span class="text-success">
                    <strong>Book successfully added : </strong>
                </span>
                <p class="bg-success" >
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success">
                            <b class="text-muted">Id  : </b> {{ $book->id }}
                        </li>
                        <li class="list-group-item list-group-item-success">
                            <b class="text-muted">Book title  : </b> {{ $book->title }}
                        </li>
                        <li class="list-group-item list-group-item-success">
                            <b class="text-muted">Releasing year  : </b> {{ $book->released_year }}
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
@endsection