
    @extends('layouts.home')

    @section('head')
    <title>Orca | Message Encode/Decode</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="wclassth=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/styles.css">
        <script type="text/javascript" src="/js/alerts.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stop

    @section('encodedUrl')
        @if(!empty($viewUrl))
                <label>Sugeneruota nuoroda</label>
                <div class="form-group input-margin">
                    <input class="form-control" onclick="this.select();" type="text" value="{{ $viewUrl }}">
                </div>
                <label>Nuoroda su galimybe ištrinti žinutę</label>
                <div class="form-group input-margin">
                    <input class="form-control" onclick="this.select();" type="text" value="{{ $ownerUrl }}">
                </div>
        @endif
    @endsection

        @if(!empty($deleteAlert))
            @push('deleteAlert')
                <div class="alert">
                    <h4>Žinutė ištrinta</h4>
                </div>
            @endpush
        @endif
        @if(!empty($doesntExitAlert))
            @push('deleteAlert')
                <div class="alert">
                    <h4>Neteisingas ID</h4>
                </div>
            @endpush
        @endif
    