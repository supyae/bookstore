<?php namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Exceptions\customValidator;

class AuthorController extends Controller {
    function __construct(Author $author,customValidator $customValidator)
    {
        $this->author = $author;
        $this->customValidator = $customValidator;
    }

	public function index()
    {
        $authors = $this->author->orderBy('id','DESC')->get(['id','name']);

        return view('authorList')->with('authors',$authors);
	}

	public function store(Request $request)
	{
       $method = 'getAuthorRules';

       if($this->customValidator->validate($request,$method)->fails()){
               return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
        $author = $this->author;
        $author->name = $request->author;
        $check = $author->save();

        $this->checkData($request, $check);

        return redirect()->back();
	}

	public function update(Request $request,$id)
	{
        $check = $this->author->where('id','=',$id)->update(['name'=> $request->authorEdit]);

        $this->checkData($request,$check);

        return redirect()->back();
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
