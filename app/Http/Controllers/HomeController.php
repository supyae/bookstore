<?php namespace App\Http\Controllers;

//use App\Author;
//use App\Genre;
//use App\Book;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
    private $book;

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
//	public function __construct(Author $author,Genre $genre,Book $book)
//	{
//		//$this->middleware('auth');
//        $this->author = $author;
//        $this->genre = $genre;
//        $this->book = $book;
//	}
//
//    public function index(){
//        return view('home');
//    }
//
//	public function bookForm()
//	{
//		//return view('home');
//        $author = $this->author->getByOrder();
//        $genre = $this->genre->getByOrder();
//
//        return view('newBook')->with(array('authors' => $author))->with('genres',$genre);
//
//	}
//
//    public function bookSave(Request $request){
//
//
//        $validator = $this->Validation($request);
//
//        if($validator->fails()){
//            return redirect()->back()
//                    ->with(session()->flash('error','Invalid Submission'));
//        }
//        else{
//           // $input = $request->all();
//
//            // upload image;
//            $destinationPath = 'uploads';
//            $image = $request->file('img');
//            $imgName = $image->getClientOriginalName();
//            //save image file at destinationPath;
//            $image->move($destinationPath,$imgName);
//
//
//            $book = $this->book;
//            $book->title = $request->title;
//            $book->description = $request->descp;
//            $book->authorId = $request->authorId;
//            $book->genreId = $request->genreId;
//            $book->pubHouse = $request->phouse;
//            $book->doj = $request->doj;
//            $book->imageFile = $imgName;
//            $book->save();
//            //return $input;
//           $request->session()->flash('msg','Upload Success !!!');
//           return redirect()->back();
//
////       //$request->session()->flash('msg','Success');
////
//
//
//       }
//
//    }
//
//    /**
//     * @param Request $request
//     */
//    // the validation method refactoring and extraction
//
//    public function Validation(Request $request)
//    {
//
//        $validator = Validator::make($request->all(),[
//            'title' => 'required',
//            'img' => 'required|image|mimes:jpeg,png|min:1|max:250'
//        ]);
//
//        return $validator;
//    }
//


}
