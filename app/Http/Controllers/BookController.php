<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Author;
use App\Genre;
use App\Book;
use Illuminate\Support\Facades\File;
use App\Exceptions\customValidator;

class BookController extends Controller {

    public function __construct(Author $author,Genre $genre,Book $book,customValidator $customValidator)
    {

        $this->author = $author;
        $this->genre = $genre;
        $this->book = $book;
        $this->customValidator = $customValidator;
    }
	public function index()
	{
		//using model relationship
        $books = $this->book->with('author','genre')->orderBy('id','DESC')->get();

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
        $author = $this->author->orderBy('id','DESC')->get(['id','name']);
        $genre = $this->genre->orderBy('type','ASC')->get(['id','type']);
        return array($author, $genre);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $method = 'getBookRules';

        if($this->customValidator->validate($request,$method)->fails()){
            return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
            $destinationPath = 'uploads';
            $image = $request->file('img');
            $imgName = $image->getClientOriginalName();

            ///// method extraction
            $imageChecker = $this->checkImage($destinationPath, $imgName);

            if($imageChecker){

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

                $this->checkData($request, $check);

                return redirect()->back();

            }
    }

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

        $method = 'getBookRules';

        if($this->customValidator->validate($request,$method)->fails()){
            return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
            //check image when it is null, no need to update;
            $image = $request->file('img');
            if(isset($image)){
                $destinationPath = 'uploads';
                $imgName = $image->getClientOriginalName();
                ///// method extraction
                $imageChecker = $this->checkImage($destinationPath, $imgName);
                if($imageChecker){
                    $image->move($destinationPath,$imgName);

                    $editData = array_add($this->getEditData($request),'imageFile',$imgName);
                    $check = $this->book->where('id','=',$id)->update($editData);
                }

            }else{
                $editData = $this->getEditData($request);

                $check = $this->book->where('id','=',$id)->update($editData);
            }

           $this->checkData($request, $check);
            return redirect()->back();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //image file is deleted at first;
        $data = $this->book->find($id);
        $imageFile = $data->imageFile;
        File::delete(public_path('uploads/'.$imageFile));

        $check = $this->book->find($id)->delete();
        if ($check == 1){
            session()->flash('msg','Deleted !!!');
        }else{
          session()->flash('error','Delete Fail !!!');
        }
        return redirect()->back();

	}

    /**
     * @param $destinationPath
     * @param $imgName
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    // check the image for duplicate insertion;
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

    /**
     * @param Request $request
     * @return array
     */
    public function getEditData(Request $request)
    {
        $editData = [
            'title'       => $request->title,
            'description' => $request->descp,
            'authorId'    => $request->authorId,
            'genreId'     => $request->genreId,
            'pubHouse'    => $request->phouse,
            'doj'         => $request->doj
        ];
        return $editData;
    }

    /**
     * @param Request $request
     * @param $check
     */
    public function checkData(Request $request, $check)
    {
        if ($check == 1) {
            $request->session()->flash('msg', ' Success !!!');
        } else {
            $request->session()->flash('error', ' Fail !!!');
        }
    }


}
