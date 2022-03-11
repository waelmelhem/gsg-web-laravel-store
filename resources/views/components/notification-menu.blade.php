<a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge " id="notificationNum">{{ count($notifications) }}</span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-header">{{ count($notifications) }} Notifications</span>
    <div class="dropdown-divider"></div>
    <div id="list">
        @foreach ($notifications as $item)
            <a href="{{ route('dashboard.notification.read', $item->id) }}" class="dropdown-item">
                @if ($item->unread())
                    <i class="fas fa-envelope mr-2"></i>
                @else
                    <i class="fas fa-envelope-open mr-2"></i>
                @endif
                {{ $item->data['title'] }}
                <span
                    class="float-right text-muted text-sm">{{ $item->created_at->diffForHumans('now', true, true) }}</span>
            </a>
        @endforeach
    </div>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
