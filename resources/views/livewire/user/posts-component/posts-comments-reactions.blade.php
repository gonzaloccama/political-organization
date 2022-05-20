<div class="like-data">
    @php
        $myLike = \App\Models\PostsCommentsReaction::where('comment_id', $comment->id)
            ->where('user_id', auth()->user()->id)
            ->first();
        $likes = \App\Models\PostsCommentsReaction::where('comment_id', $comment->id)->get()->count();
    @endphp

    <div class="dropdown">
        @if($myLike)
            <a href="" class="dropdown-toggle" data-toggle="dropdown"
               wire:click.prevent="deleteCommentsLike({{$myLike->id}})"
               aria-haspopup="true" aria-expanded="false" role="button">
                <img
                    src="{{ asset('assets/images/icon/'.$myLike->reaction.'.png') }}"
                    class="img-fluid" alt="">
            </a>
        @else
            <a href="" class="dropdown-toggle" data-toggle="dropdown"
               {{--               wire:click.prevent="storePostsCommentsReaction({{$comment->id}}, {{ auth()->user()->id }}, 'like-my')"--}}
               wire:click.prevent="$emitTo('media-posts-component', 'refreshComponent')"
               aria-haspopup="true" aria-expanded="false" role="button">
                <img
                    src="{{ asset('assets/images/icon/like.png') }}"
                    class="img-fluid" alt="">
            </a>
        @endif
        <div class="dropdown-menu w-auto shadow border">
            @if($myLike)
                <a class="ml-2 mr-2 reactions" href="#"
                   data-toggle="tooltip" data-placement="top"
                   wire:click.prevent="updatePostsCommentsReaction({{ $myLike->id }}, 'like-my')"
                   title="" data-original-title="Me gusta"><img
                        src="{{ asset('assets/images/icon/like-1.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="mr-2 reactions" href="#" data-toggle="tooltip"
                   wire:click.prevent="updatePostsCommentsReaction({{ $myLike->id }}, 'heart-my')"
                   data-placement="top" title="" data-original-title="Me encanta"><img
                        src="{{ asset('assets/images/icon/heart.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="reactions" href="#" data-toggle="tooltip"
                   data-placement="top" title=""
                   wire:click.prevent="updatePostsCommentsReaction({{ $myLike->id }}, 'happy-my')"
                   data-original-title="Estoy feliz"><img
                        src="{{ asset('assets/images/icon/happy.png') }}"
                        class="img-fluid" alt=""></a>
            @else
                <a class="ml-2 mr-2 reactions" href="#"
                   data-toggle="tooltip" data-placement="top"
                   wire:click.prevent="storePostsCommentsReaction({{$comment->id}}, {{ auth()->user()->id }}, 'like-my')"
                   title="" data-original-title="Me gusta"><img
                        src="{{ asset('assets/images/icon/like-1.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="mr-2 reactions" href="#" data-toggle="tooltip"
                   wire:click.prevent="storePostsCommentsReaction({{$comment->id}}, {{ auth()->user()->id }}, 'heart-my')"
                   data-placement="top" title="" data-original-title="Me encanta"><img
                        src="{{ asset('assets/images/icon/heart.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="reactions" href="#" data-toggle="tooltip"
                   data-placement="top" title=""
                   wire:click.prevent="storePostsCommentsReaction({{$comment->id}}, {{ auth()->user()->id }}, 'happy-my')"
                   data-original-title="Estoy feliz"><img
                        src="{{ asset('assets/images/icon/happy.png') }}"
                        class="img-fluid" alt=""></a>
            @endif
        </div>
    </div>
</div>
<a href="javascript:;" class="ml-1">{{ $likes == 1 ? $likes.' like' : $likes.' likes' }}</a>

