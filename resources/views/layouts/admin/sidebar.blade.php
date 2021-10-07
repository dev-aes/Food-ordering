<div class="d-flex flex-column flex-shrink-0  bg-light" style="width: 280px;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a  href="{{ route('admin.dashboard.index') }}" class="nav-link" aria-current="page">
          <i class="fas fa-home nav-icon mr-1"></i>
          Home
        </a>
      </li>
      <li>
        <a href="{{route('admin.category.index')}}" class="nav-link link-dark">
            <i class="fas fa-tags nav-icon mr-1"></i>
          Category
        </a>
      </li>
      <li>
        <a href="{{ route('admin.product.index') }}" class="nav-link link-dark">
            <i class="fas fa-hamburger nav-icon mr-1"></i>
          Products
        </a>
      </li>
      <li>
        <a href="{{ route('admin.tax.index') }}" class="nav-link link-dark">
            <i class="fas fa-percentage nav-icon mr-1"></i>
          Tax
        </a>
      </li>
      <li>
        <a href="{{ route('admin.coupon.index') }}" class="nav-link link-dark">
            <i class="fas fa-tag nav-icon mr-1"></i>
          Coupons
        </a>
      </li>
    </ul>
    <hr>
</div>