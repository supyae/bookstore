@extends('appp')

@section('content')

<div class="main">

    <div class="main-inner">

        <div class="container" style='width: 98%;'>

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

                                <table class="table">
                                    <tr>

                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Genre</th>
                                        <th>Publishing House</th>
                                        <th>Date of Join</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($books as $book)
                                    <tr>

                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author->name }}</td>
                                        <td>{{ $book->genre->type }}</td>
                                        <td>{{ $book->pubHouse }}</td>
                                        <td>{{ $book->doj }}</td>
<!--                                        <td>{!! Html::link('/book', 'Edit', array('id'=>'1'),array('class'=> 'btn')) !!} </td>-->
                                        <td>
                                            {!! Html::linkRoute('editBook', 'Edit', array('id'=> $book->id ), array('class'=>'btn')) !!}

                                            {!! Html::linkRoute('deleteBook', 'Delete', array('id'=> $book->id ), array('class'=>'btn')) !!}

                                        </td>
                                    </tr>
                                    @endforeach


                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
