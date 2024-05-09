<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import New Locations</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('common/header')
    
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                
                @include('common/alerts')

                <form method="post" action="{{ route('changeMarkersFile') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Enter Json Content</label>
                        <textarea class="form-control" id="file" name="content" aria-describedby="fileHelp" required></textarea>

                        @error('content')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" id="subBtn" class="btn btn-primary">Import</button>
                        <a class="btn btn-success" href="{{ route('downloadMarkers') }}">Download all Locations</a>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-5">
            </div>
        </div>
    </div>

</body>

</html>