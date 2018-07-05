
<li class="dropdown direct-messages-notification">
    <a href="{{ url('direct-messages') }}" class="dropdown-toggle parent"  role="button" aria-expanded="false">
        <i class="fa fa-envelope"></i>
    </a>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle parent" data-toggle="dropdown" role="button" aria-expanded="false">
        @if(count(App\Library\sHelper::notifications()) > 0)<span class="badge badge-notify">{{ count(App\Library\sHelper::notifications()) }}</span>@endif
        <i class="	fa fa-group"></i>
    </a>
    <ul class="dropdown-menu" role="menu">
        @if(count(App\Library\sHelper::notifications()) == 0)
            <li style="padding: 10px"><a href="javascript:;">No hay notifications!!</a></li>
        @else
            @foreach(App\Library\sHelper::notifications() as $notification)
                <li>
                    <a href="{{ $notification['url'] }}">
                        <i class="fa {{ $notification['icon'] }}"></i> {{ $notification['text'] }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</li>
