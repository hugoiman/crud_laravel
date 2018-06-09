{{ Session::get('message') }}
<br>
All Crud List

@foreach ($cruds as $crud)
  <a href="/laravel_crud/public/crud/{{$crud->slug}}"> <p> {{ $crud->title }} </p> </a>
  <p> {{ $crud->subject }} </p>
  <p> Tanggal di buat : {{ date('F d,Y', strtotime($crud->created_at)) }} </p>
  <p> Tanggal di update : {{ date('F d,Y', strtotime($crud->updated_at)) }} </p>
  <a href="/laravel_crud/public/crud/{{$crud->id}}/edit">Edit</a>
  <form class="" action="/laravel_crud/public/crud/{{$crud->id}}" method="post">
    <input type="hidden" name="_method" value="delete">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" name="name" value="delete">
  </form>
  <hr>
@endforeach

{!! $cruds->links() !!}
