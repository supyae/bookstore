<?php namespace App\Http\Controllers;

use App\Http\Requests;
//use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Author;
use App\Genre;
use App\Book;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller {

    public function __construct(Author $author,Genre $genre,Book $book)
    {
        //$this->middleware('auth');
        $this->author = $author;
        $this->genre = $genre;
        $this->book = $book;
    }
	public function index()
	{
		//using model relationship
        $books = $this->book->with('author','genre')->orderBy('id','DESC')->get();
        //return $books;
        return view('bookList')->with('books',$books);
	}

    // add new book section;

    public function bookForm()
    {
        //return view('home');
        list($author, $genre) = $this->getAuthorGenre();

        return view('newBook')->with(array('authors' => $author))->with('genres',$genre);

    }

    /**
     * @return array
     */
    // method extraction;
    public function getAuthorGenre()
    {
        $author = $this->author->getByOrder();
        $genre = $this->genre->getByOrder();
        return array($author, $genre);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $validator = $this->Validation($request);

        if($validator->fails()){
            return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
        else{
            // $input = $request->all();

            ////// check upload image is already exist or not;
            $destinationPath = 'uploads';
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName();

            ///// method extraction
            $imageChecker = $this->checkImage($destinationPath, $imgName);

            if($imageChecker){
                // upload image;

                //save image file at destinationPath;
                $image->move($destinationPath,$imgName);

                $book = $this->book;
                $book->title = $request->title;
                $book->description = $request->descp;
                $book->authorId = $request->authorId;
                $book->genreId = $request->genreId;
                $book->pubHouse = $request->phouse;
                $book->doj = $request->doj;
                $book->imageFile = $imgName;
                $check = $book->save();

                if ($check == 1){
                     $request->session()->flash('msg','Upload Success !!!');
                }else{
                    $request->session()->flash('error','Insertion Fail !!!');
                }

                //return $input;

                return redirect()->back();

            }


	    }
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $data = $this->book->with('author','genre')->where('id','=',$id)->first();

       //list($author, $genre) = $this->getAuthorGenre();
        $author = $this->author->lists('name','id');
        $genre = $this->genre->lists('type','id');

       return view('EditForm')->with('data',$data)->with('authors',$author)->with('genres',$genre);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{

        $validator = $this->Validation($request);

        if($validator->fails()){
            return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
        else{
            //check image when it is null, no need to update;
            $image = $request->file('img');
            if(isset($image)){
                $destinationPath = 'uploads';
                $imgName = $image->getClientOriginalName();
                ///// method extraction
                $imageChecker = $this->checkImage($destinationPath, $imgName);
                if($imageChecker){

                    // one way for updating;
                    //  $editData =  $this->book->find($id);
                    //  $editData->title = 'Another One';
                    //  $editData->save();

                    $image->move($destinationPath,$imgName);
                    $editData =[
                        'title' => $request->title,
                        'description' => $request->descp,
                        'authorId' => $request->authorId,
                        'genreId' => $request->genreId,
                        'pubHouse' => $request->phouse,
                        'doj' => $request->doj,
                        'imageFile' => $imgName
                    ];
                  $check = $this->book->where('id','=',$id)->update($editData);
                }

            }else{
                $editData = [
                    'title' => $request->title,
                    'description' => $request->descp,
                    'authorId' => $request->authorId,
                    'genreId' => $request->genreId,
                    'pubHouse' => $request->phouse,
                    'doj' => $request->doj
                ];

               $check = $this->book->where('id','=',$id)->update($editData);
            }

            if ($check == 1){
                    $request->session()->flash('msg','Update Success !!!');
                }else{
                    $request->session()->flash('error','Update Fail !!!');
                }
            return redirect()->back();

        }


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $check = $this->book->find($id)->delete();

        if ($check == 1){
            session()->flash('msg','Deleted !!!');
        }else{
          session()->flash('error','Delete Fail !!!');
        }
        return redirect()->back();

	}



    /**
     * @param Request $request
     */
    // the validation method refactoring and extraction

    public function Validation(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'img' => 'image|mimes:jpeg,png|min:1|max:250'
        ]);

        return $validator;
    }

    /**
     * @param $destinationPath
     * @param $imgName
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    // the checkImage method extraction
    public function checkImage($destinationPath, $imgName)
    {

        $path = public_path() . '/' . $destinationPath . '/' . $imgName;

        if (File::exists($path)) {
            return redirect()->back()
                ->with(session()->flash('error', 'This uploaded file is already exist'));
        } else {
            return true;

        }
    }


}
