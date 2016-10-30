@extends('layouts.app')

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
    
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Adding book</h3>
            </div>

            <div class="panel-body">

                <form action="{{ url('/createBook')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Book title</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
                            @if ($errors->has('title'))
                                <span class="text-warning">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="released_year" class="col-md-4 control-label">Releasing year</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="released_year" name="released_year" placeholder="Released year"/>
                        </div>
                        <div class="clearfix">
                        </div>
                        <div class="col-md-5 col-md-offset-4">
                            @if ($errors->has('released_year'))
                                <span class="text-warning">
                                    <strong>{{ $errors->first('released_year') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="col-md-4 control-label">Category</label>
                        <div class="col-md-3">
                            <select multiple name="category[]" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Add book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection