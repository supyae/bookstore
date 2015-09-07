<?php namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Exceptions\customValidator;


class GenreController extends Controller {
    function __construct(Genre $genre,customValidator $customValidator)
    {
        $this->genre = $genre;
        $this->customValidator = $customValidator;
    }


	public function index()
	{
		$genres = $this->genre->orderBy('id','DESC')->get();
        return view('genreList')->with('genres',$genres);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $method = 'getGenreRules';

        if($this->customValidator->validate($request,$method)->fails()){
            return redirect()->back()
                ->with(session()->flash('error','Invalid Submission'));
        }
        $genre = $this->genre;
        $genre->type = $request->genre;
        $check = $genre->save();

        $this->checkData($request, $check);

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

    public function update(Request $request,$id)
	{
        $check = $this->genre->where('id','=',$id)->update(['type'=> $request->genreEdit]);

        $this->checkData($request,$check);

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
		//
	}

}
