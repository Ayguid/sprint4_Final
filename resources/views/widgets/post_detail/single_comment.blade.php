

<div class="panel-default post-comment" id="post-comment-{{ $comment->id }}">
    <div class="panel-body">
        <div class="pull-left">
            <a href="{{ url('/'.$comment->user->username) }}">
                <img class="media-object img-circle comment-profile-photo" src="{{ $comment->user->getPhoto(60,60) }}">
            </a>
        </div>
        <div class="pull-left comment-info">
            <a href="{{ url('/'.$comment->user->username) }}" class="name">{{ $comment->user->name }}</a>
            <a href="{{ url('/'.$comment->user->username) }}" class="username">{{ '@'.$comment->user->username }}</a>
            <span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $comment->created_at->diffForHumans() }}</span>
            @if($post->user_id == Auth::id() || $comment->comment_user_id == Auth::id())
                <a href="javascript:;" class="remove pull-right" onclick="removeComment({{ $comment->id }}, {{ $post->id }})"><i class="fa fa-times"></i></a>
            @endif
            <div class="clearfix"></div>
        </div>
        <br />
        <p>

            {{-- Convierte el texto de los comentarios a links --}}
          @php
          $string = $comment->comment;
          preg_match_all('#(\w*://|www\.)[a-z0-9]+(-+[a-z0-9]+)*(\.[a-z0-9]+(-+[a-z0-9]+)*)+(/([^\s()<>;]+\w)?/?)?#i', $string, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
          foreach (array_reverse($matches) as $match) {
            $a = '<a target="new" href="'.(strpos($match[1][0], '/') ? '' : 'http://') . $match[0][0].'">' . $match[0][0] . '</a>';
            $string = substr_replace($string, $a, $match[0][1], strlen($match[0][0]));
          }
          echo $string;
            @endphp





        </p>
    </div>
</div>

<div class="clearfix"></div>

<hr />
