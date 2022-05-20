<div class="like-data">
    @php
        $myLike = \App\Models\PostsReaction::where('post_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        /*$like = ['like-my', 'heart-my', 'happy-my'];
        $cLike = [];

        foreach ($like as $l){
        $cLike[$l] = \App\Models\MediaPostsReaction::where('post_id', $post->id)
            ->where('reaction', $l)->pluck('reaction')->count();
        }*/
    @endphp

    <div class="dropdown">
        @if(filled($myLike))
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
               wire:click.prevent="deleteLike({{$myLike->id}})"
               aria-haspopup="true" aria-expanded="false" role="button">
                <img
                    src="{{ asset('assets/images/icon/'.$myLike->reaction.'.png') }}"
                    class="img-fluid" alt="">
            </a>
        @else
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
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
                   wire:click.prevent="updatePostsReaction({{ $myLike->id }}, 'like-my')"
                   title="" data-original-title="Me gusta"><img
                        src="{{ asset('assets/images/icon/like-1.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="mr-2 reactions" href="#" data-toggle="tooltip"
                   wire:click.prevent="updatePostsReaction({{ $myLike->id }}, 'heart-my')"
                   data-placement="top" title="" data-original-title="Me encanta"><img
                        src="{{ asset('assets/images/icon/heart.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="reactions mr-1 pr-1" href="#" data-toggle="tooltip"
                   data-placement="top" title=""
                   wire:click.prevent="updatePostsReaction({{ $myLike->id }}, 'happy-my')"
                   data-original-title="Estoy feliz"><img
                        src="{{ asset('assets/images/icon/happy.png') }}"
                        class="img-fluid" alt=""></a>
            @else
                <a class="ml-2 mr-2 reactions" href="#"
                   data-toggle="tooltip" data-placement="top"
                   wire:click.prevent="storePostsReaction({{$post->id}}, {{ auth()->user()->id }}, 'like-my')"
                   title="" data-original-title="Me gusta"><img
                        src="{{ asset('assets/images/icon/like-1.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="mr-2 reactions" href="#" data-toggle="tooltip"
                   wire:click.prevent="storePostsReaction({{$post->id}}, {{ auth()->user()->id }}, 'heart-my')"
                   data-placement="top" title="" data-original-title="Me encanta"><img
                        src="{{ asset('assets/images/icon/heart.png') }}"
                        class="img-fluid" alt=""></a>
                <a class="reactions mr-1 pr-1" href="#" data-toggle="tooltip"
                   data-placement="top" title=""
                   wire:click.prevent="storePostsReaction({{$post->id}}, {{ auth()->user()->id }}, 'happy-my')"
                   data-original-title="Estoy feliz"><img
                        src="{{ asset('assets/images/icon/happy.png') }}"
                        class="img-fluid" alt=""></a>
            @endif
        </div>
    </div>
</div>
