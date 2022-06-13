@if($comments->count() > 0)
    @foreach($comments as $comment)
        <div class="card rounded bg-light shadow my-3">
            <div class="card-body">
                <h5 class="card-title text-primary">
                    {{$comment->fullname}}
                    <span class="badge rounded bg-primary float-end">{{$comment->created_at->diffForHumans()}}</span>
                </h5>
                <div class="card-text">{{$comment->content}}</div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-primary">Henüz yorum yapılmamış. Hadi ilk yorumu sen yap.</div>
@endif
