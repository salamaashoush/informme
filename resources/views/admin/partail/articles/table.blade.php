<table id="indextable" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Edit</th>
        <th>View</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    @if($model->articles->count())
        @foreach($model->articles as $article)
            <tr>
                <td>{{$article->title}}</td>
                <td>{{$article->type}}</td>
                <td><a href="{{route('articles.edit',$article->id)}}"><span class="fa fa-edit"></span></a></td>
                <td><a href="{{route('articles.show',$article->id)}}"><span class="fa fa-book"></span></a></td>
                <td>
                    {!! Form::open(array('method'=>'DELETE','route' => ['articles.destroy',$article->id],'files'=>'true')) !!}
                    <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                        <span class="fa fa-remove"></span>
                    </button>
                    {!! Form::close()!!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <th>Title</th>
        <th>Type</th>
        <th>Edit</th>
        <th>View</th>
        <th>Delete</th>
    </tr>
    </tfoot>
</table>