<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Ujikom Video </title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- You can add more navbar items here if needed -->
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                    <a class="btn btn-success" href="{{ route('video.create') }}">Add</a>
                    @csrf
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @foreach ($video as $videos)
            <div class="position-relative d-inline-block">
                <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('/storage/'.$videos->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('video.destroy',$videos->id) }}" method="POST" class="position-absolute" style="top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin video ini?')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </form>
            </div>
            <div>{{ $videos->created_at->format('d F Y') }}</div>
            <div>{{ $videos->caption }}</div>
            <br>
        @endforeach
    </div>
    {{ $video->links() }}

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>