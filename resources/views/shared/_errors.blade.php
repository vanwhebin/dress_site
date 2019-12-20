@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
<<<<<<< HEAD
            @foreach($error->all() as $error)
=======
           @foreach($error->all() as $error)
>>>>>>> e99dfc4475a9c658dc7b227e14c6314502cca350
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
<<<<<<< HEAD
@endif
=======
@endif
>>>>>>> e99dfc4475a9c658dc7b227e14c6314502cca350
