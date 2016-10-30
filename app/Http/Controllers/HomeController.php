<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Book; 
use App\Category; 
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard listing the registered books
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::all();
        $user = Auth::user();
        $categories = Category::all()->lists("category_name", "id");

        foreach ($categories as $category)
        {
//            echo $category->id." => ".$category->category_name."<br/>";
        }
        
        if(!empty($request->category))
        {
            $books = Category::find($request->category)->books;
        }
       
        
        return view('home', array('books' => $books, 'user' => $user, 'categories' => $categories));
    }
    
    public function searchByCategory(Request $request, $categoryId = null ) 
    {
        echo $request->category." | ".$categoryId;
        $user = Auth::user();
        if(!empty($request->category))
        {
            
        }
        $categories = Category::all()->lists("category_name", "id");
        
        
//        return view('home', array('books' => $books, 'user' => $user, 'categories' => $categories));
    }
    
    public function showBookCreationForm() 
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('bookCreationForm', ["categories" => $categories, 'user' => $user]);
    }
    
    public function createBook(Request $request) 
    {
//        echo $request->user()." | ".$request->title." | ".$request->released_year." | <br/>";
//        print_r($request->category);
        
        $this->validate(
                        $request,
                        array(
                                "title" => "required|max:100",
                                "released_year" => "required|date_format:Y",
                             ),
                        array(
                                "released_year.date_format" => "The released year does not match the format yyyy (eg : 2016)"
                             )
                       );
        
//        Validator::make(
//                            $request->all(), 
//                            array(
//                                    "title" => "required|max:100",
//                                    "released_year" => "required|date_format:Y",
//                                 )
//                       );
        
        $category = Category::find($request->category);
        $book = new Book();
        
        //Setting books.title
        $book->title = $request->title;
        //Setting books.released_year
        $book->released_year = $request->released_year;
        //Associate logged in user for book creation
        $book->user()->associate($request->user());
        //Insert the sets of data
        $book->save();
        
        //Insert data from the choosen category and the fresh 
        //inserted book in the inermediary table books_categories
        $book->categories()->attach($request->category);
//        var_dump($category);
//        var_dump($request->user());
        
        return view('createdBook', ["user" => $request->user(),"book" => $book]);
    }
    
    public function deleteBook($bookId) 
    {
        $user = Auth::user();
        $book = Book::find($bookId);
        $book->is_deleted = true;
        $book->save();
        
        
//        $book->categories()->detach($bookId);
        return view('deletedBook', array("user" => $user, "book" => $book));
    }
    
    public function deleteForRealBook($bookId) 
    {
        $user = Auth::user();
        $book = Book::find($bookId);
        
        $categoryId = null;
        foreach($book->categories as $category)
        {
            $categoryId = $category->id ;
        }
        $category = Category::find($categoryId);
        $category->books()->detach($bookId);
        
        return view('deletedForRealBook', array("user" => $user, "book" => $book));
    }
}
