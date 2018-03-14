@extends('layouts.decodedMsg')

@section('head')
<title>Orca | Message Encode/Decode</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="wclassth=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css"/>
    <script type="text/javascript" src="/js/countdown.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
@endsection


@section('decodedMsg')
    <textarea class="form-control" rows="10" >{{ $text }}</textarea>
@endsection

@section('time')
    <div class="right-box">  
        <div class="panel panel-default">
            <div class="panel-heading">
                Žinutė ištrinama už:
            </div>
            <div class="panel-body">
                <span class="hidden" id="delete">{{ $time }}</span>
                <h4 id="time"></h4>
                @if($owner == true)
                    <div class="forma">
                    <form METHOD="get" action="/delete">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="delID" value="{{ $dId }}">
                        <input type="hidden" name="delKey" value="{{ $dKey }}">
                        <input type="hidden" name="delown" value="{{ $dHash }}">
                        <button type="submit" class="btn btn-p">Istrinti</button>
                    </form> 
                    </div> 
                @endif
            </div>
        </div>
    </div>
@endsection

