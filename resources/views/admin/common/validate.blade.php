@if($errors->any())
    <div class="Huialert Huialert-error">
        <i class="Hui-iconfont">&#xe6a6</i>
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif
