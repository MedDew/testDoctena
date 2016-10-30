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
    
    <div class="row" style="margin-bottom: 1em;">
        <div class="col-md-4">
            <?php echo Form::model($categories, ['action' => 'HomeController@searchByCategory', 'method' => 'GET','class' => 'form-inline']); ?>
                <div class="form-group">
                    <?php echo Form::select("category", $categories, null, array('placeholder' => "Select a category", "class" => "form-control" )); ?>
                    <?php echo Form::submit("Search", array("class" => "btn btn-primary")); ?>
                </div>
            <?php echo Form::close(); ?>
        </div>
    </div>
    
    
    <div class="panel panel-default">
        <div class="panel-heading">Book list inserted by users</div>
        <table class="table">
            <thead>
                <th>#</th>
                <th>Book Id</th>
                <th>Insert by user</th>
                <th>Book title</th>
                <th>Category</th>
                <th>Released year</th>
                <th>Deleted</th>
                <th>To delete</th>
                <th>Real deletion</th>
            </thead>
            @for($i = 0; $i < count($books); $i++)
                <tr>
                    <th>{{ $i+1 }}</th>
                    {{-- $books[$i]->categories <br/><br/> --}}
                    
                    <td>{{ $books[$i]->id }}</td>
                    @if(empty($books[$i]->user_id))
                        <td>None</td> 
                    @else
                        <td>{{ $books[$i]->user->firstname }} {{ $books[$i]->user->lastname }}</td> 
                    @endif
                    
                    <td style="max-width: 420px;">{{ $books[$i]->title }}</td>
                    
                    <td>
                        <ul style="margin: 0;padding: 0">
                            @foreach($books[$i]->categories as $category)
                                <li>{{ $category->category_name }}</li>
                                {{--<td>{{ $category->pivot->book_id }}</td>--}}
                                {{--<td>{{ $category->pivot->category_id }}</td>--}}
                            @endforeach
                        </ul>
                    </td>
                    
                    <td>{{ $books[$i]->released_year }}</td>
                    @if($books[$i]->is_deleted == 0)
                        <td>Borrowable</td>
                    @else
                        <td>Unborrowable</td>
                    @endif

                    <td>
                        <a href="{{ url('deleteBook') }}/{{ $books[$i]->id }}" class="btn btn-warning">DELETE</a>
                    </td>
                    
                    <td>
                        <div class="list-group">
                            <a href="{{ url('deleteForRealBook') }}/{{ $books[$i]->id }}" class="list-group-item btn btn-danger disabled">DELETE</a>
                        </div>
                    </td>
                    
                </tr>
            @endfor
            
        </table>
    </div>
    
</div>
@endsection
