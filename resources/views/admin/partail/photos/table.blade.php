<table id="indextable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Tag</th>
        <th>Path</th>
        <th>Photo</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>

    @foreach($governorate->photos as $photo)
        <tr>
            <td><a href="{{url(asset($photo->url))}}">{{$photo['name']}}</a></td>
            <td>{{$photo['tag']}}</td>
            <td>{{asset($photo->url)}}</td>
            <td><img src="{{asset($photo['url'])}}" alt="{{$photo['name']}}" width="50"></td>
            <td>
                {!! Form::open(array('method'=>'DELETE','route' => ['photos.destroy',$photo->id],'files'=>'true')) !!}
                <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                    <span class="fa fa-remove"></span>
                </button>
                {!! Form::close()!!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Tag</th>
        <th>Photo</th>
        <th>Delete</th>
    </tr>
    </tfoot>
</table>