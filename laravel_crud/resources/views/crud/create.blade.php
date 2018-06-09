<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="" action="/laravel_crud/public/crud" method="post">
  <input type="text" name="title" value="" placeholder="judul">
  <!-- jika ingin menampilkan eror di bawah inputan -->
  {{ ($errors->has('title')) ? $errors->first('title') : '' }}
  <br>
  <textarea name="subject" rows="8" cols="40" placeholder="isi..."></textarea>
  {{ ($errors->has('subject')) ? $errors->first('subject') : '' }}
  <br>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="submit" name="name" value="post">
</form>
