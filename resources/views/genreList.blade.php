@extends('appp')

@section('content')

<script>
    $(document).ready(function(){

        // for new genre form
        $('#new').click(function(){
            $('#newform').css({display:"block"});
            $('#new').css({display:"none"});

        });
        $('#newformBack').click(function(){
            $('#newform').css({display:"none"});
            $('#new').css({display:"block"});
        });

       // for edit section;
        $('.btn').click(function(){
            var self = $(this);
            var id = self.data('id');
            $('.edit'+id).css({display:"block"});
            $('.origin'+id).css({display:"none"});
        });


    })
</script>

<div class="main">

    <div class="main-inner">

        <div class="container" style='width: 98%;'>

            <div class="row">

                <div class="span12">

                   <div id="new"> {!! Form::button('New',['class'=> 'btn','id'=> 'new']) !!}
                   {!! Form::close() !!}</div>


                    <div class="table-responsive" id="newform" style="display: none;">
                        {!! Form::open(array('route' => 'genreSave','method'=>'POST')) !!}
                        <table border="0" class='table-condensed'>

                                <td>
                                    Type
                                </td>
                                <td>
                                    <div class="form-group">
                                        {!! Form::text('genre',null,['class'=>'form-control','placeholder'=>'Enter Type']) !!}
                                    </div>

                                </td>
                            <tr><td></td><td> {!! Form::submit('Save',['class'=>'btn']) !!}
                                        {!! Form::button('Cancel',['class'=>'btn','id'=>'newformBack']) !!}

                                </td>
                            </tr>

                        </table>
                        {!! Form::close() !!}
                    </div>




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

                                        <th>Genre</th>
                                        <th>Action</th>
                                    </tr>

                                    @foreach($genres as $genre)
                                    <tr>

                                        <td><div class="origin{{$genre->id}}" style="display:block">{!! $genre->type !!}</div>
                                            <div class="edit{{$genre->id}}" style="display: none;">
                                                {!! Form::open(array('url' => "/genre/genreEdit/$genre->id",'method'=>'POST')) !!}
                                                {!! Form::text('genreEdit',$genre->type,['class'=>'form-control']) !!}
                                                {!! Form::submit('Save',['class'=>'btn']) !!}
                                                {!! Html::linkRoute('editBack', 'Cancel', array(), array('class'=>'btn')) !!}

                                                {!! Form::close() !!}

                                            </div>

                                        </td>
                                        <td>

                                            <input type="button" data-id="{{$genre->id}}" value="Edit" class="btn">

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
