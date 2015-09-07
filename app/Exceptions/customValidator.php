<?php namespace App\Exceptions;

    use App\Http\Requests;
    use Illuminate\Http\Request;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Illuminate\Support\Facades\Validator;


class customValidator extends ExceptionHandler
    {
        //book
        public function getBookRules(){
            return [
                'title' => 'required',
                'descp' => 'required',
                'phouse' => 'required',
                'doj' => 'required',
                'img' => 'image|mimes:jpeg,png|min:1|max:250'
            ];
        }

        //author
        public function getAuthorRules()
        {
            return [
                'author' => 'required'
            ];
        }

        //genre
        public function getGenreRules()
        {
            return [
                'genre' => 'required'
            ];
        }

        public function validate(Request $request,$method)
        {

            $validator = Validator::make($request->all(), $this->$method());
            return $validator;

        }


    }

?>
