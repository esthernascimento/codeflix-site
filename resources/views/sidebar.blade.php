<aside class="sidebar">
    <ul>
        <li><a href="#"><i class="bi bi-house-door-fill"></i></a></li>
        <li><a href="{{ url('/suporte.blade.php') }}"><i class="bi bi-people-fill"></i></a></li>
        <li><a href="#"><i class="bi bi-question-circle-fill"></i></a></li>
        <li><a href="#"><i class="bi bi-lock-fill"></i></a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Sair" style="background:none;border:none;cursor:pointer;">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </li>
    </ul>
</aside>