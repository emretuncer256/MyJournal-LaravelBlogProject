@isset($categories)
    <div class="list-group shadow-sm">
        <a class="list-group-item list-group-item-action active" aria-current="true">
            Kategoriler
        </a>
        @foreach($categories as $category)
            @if($category->articleCount(true) > 0)
                <a
                    @if(Request::segment(2)!=$category->slug) href="{{route('category', $category->slug)}}" @endif
                class="list-group-item list-group-item-action
                @if(Request::segment(2)==$category->slug) bg-info text-white @endif">
                    {{@$category->name}} <span class="badge bg-primary float-end">{{$category->articleCount(true)}}</span>
                </a>
            @endif
        @endforeach
    </div>
@endisset
