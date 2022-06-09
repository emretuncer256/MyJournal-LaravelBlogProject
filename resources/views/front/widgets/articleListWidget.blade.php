@if(count($articles)>0)
    @foreach($articles as $article)
        <!-- Post preview-->
        <div class="post-preview shadow pb-2">
            <a href="{{route('single', [$article->getCategory->slug, $article->slug])}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <img class="img-fluid" src="{{asset($article->image)}}" alt="image">
                <h3 class="post-subtitle">{!! \Illuminate\Support\Str::limit($article->content, 50) !!}</h3>
            </a>
            <p class="post-meta">
                Kategori:
                <a href="#!">
                    <span class="badge bg-primary rounded-3">{{$article->getCategory->name}}</span>
                </a>
                <span class="float-end">{{date_format($article->created_at, 'F j, Y')}}</span>
            </p>

        </div>
        <!-- Divider-->
        @if(!$loop->last)
            <hr class="my-4"/>
        @endif
    @endforeach

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" @if(!$articles->first())href="{{$articles->previousPageUrl()}}"@endif>
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for($i=1;$i<=$articles->lastPage();$i++)
                @if($i==request('page'))
                    <li class="page-item active">
                        <a class="page-link">{{$i}}</a>
                    </li>
                @elseif(is_null(request('page')) & $i==1)
                    <li class="page-item active">
                        <a class="page-link">{{$i}}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{$articles->url($i)}}">{{$i}}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item">
                <a class="page-link" @if(!$articles->last())href="{{$articles->nextPageUrl()}}"@endif>
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
@else
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill"/>
        </svg>
        <div>
            Bu kategoriye ait hiçbir yazı bulunamadı.
        </div>
    </div>
@endif
