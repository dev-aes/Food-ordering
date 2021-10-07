<div class="d-flex flex-column flex-shrink-0  bg-light" style="width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a  href="{{ route('user.dashboard.index') }}" class="nav-link" aria-current="page">
          <i class="fas fa-home nav-icon mr-1"></i>
          Home
        </a>
      </li>
      <li>
        <a href="{{ route('user.order.index') }}" class="nav-link link-dark">
            <i class="fas fa-utensils nav-icon mr-1"></i>
          Order now
        </a>
      </li>
    </ul>
    <hr>
</div>