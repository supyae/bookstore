@extends('appp')

@section('content')

<div class="main">

    <div class="main-inner">

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div id="target-1" class="widget">

                        <div class="widget-content">

                            @if ( Session::has('msg') )

                            <div class="alert {{ Session::get('flash_type') }}">
                                <h3>{{ Session::get('msg') }}</h3>
                            </div>

                            @endif


                            @if ( Session::has('error') )

                            <div class="alert {{ Session::get('flash_type') }}">
                                <h3>{{ Session::get('error') }}</h3>
                            </div>

                            @endif


                            <div class="table-responsive">

                                {!! Form::open(array('url' => '/bookSave','method'=>'POST', 'files' => true)) !!}
                                <table border="0" class='table-condensed'>
                                    <tr>
                                        <td>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td>
                                            Title
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!!
                                                Form::text('title',null,['class'=>'form-control','placeholder'=>'Enter Author Name']) !!}
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>

                                        <td>
                                            Description
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!!
                                                Form::textarea('descp',null,['class'=>'form-control','rows'=>'5','cols'=>'20','placeholder'=>'Enter Description']) !!}
                                            </div>

                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Author Name</td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::select('authorId',array_pluck($authors, 'name', 'id')) !!}
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Genre</td>
                                        <td>
                                            <div class="form-group">

                                                {!! Form::select('genreId',array_pluck($genres, 'type', 'id')) !!}
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Publishing House</td>
                                        <td>
                                            <div class="form-group">
                                                {!!
                                                Form::text('phouse',null,['class'=>'form-control','placeholder'=>'Enter Publishing house']) !!}
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Date of Join</td>
                                        <td>
                                            <!--    <input type="text" name="doj" size="30" class="dtpick" readonly="readonly" />-->
                                            {!! Form::text('doj',null,['class'=>'dtpick']) !!}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Upload Image</td>
                                        <td>
                                            <div class="form-group">
                                                <label>Book Image Upload</label>
                                                {!! Form::file('img',['class'=>'form-control']) !!}

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>

                                        <td>
                                            {!! Form::submit('Save',['class'=>'btn']) !!}
                                        </td>
                                    </tr>
                                </table>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection