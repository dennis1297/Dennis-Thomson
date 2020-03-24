<div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-item" id="dashboard">
              <a href="<?php echo ADMINURL?>dashboard">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
              </a>  
            </li>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                <span class="site-menu-title">Catalog</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?php echo ADMINURL?>category-list">
                    <span class="site-menu-title">Categories</span>
                  </a>
                </li>
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?php echo ADMINURL?>product-list">
                    <span class="site-menu-title">Products</span>
                  </a>
                </li>
				        <li class="site-menu-item">
                  <a class="animsition-link" href="<?php echo ADMINURL?>view-options">
                    <span class="site-menu-title">Options</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="site-menu-item has-sub">
              <a href="javascript:void(0)">
                <i class="site-menu-icon wb-shopping-cart" aria-hidden="true"></i>
                <span class="site-menu-title">Sales</span>
                <span class="site-menu-arrow"></span>
              </a>
              <ul class="site-menu-sub">
                <li class="site-menu-item">
                  <a class="animsition-link" href="<?php echo ADMINURL?>orders-list">
                    <span class="site-menu-title">Orders</span>
                  </a>
                </li>                
              </ul>
            </li>

            <li class="site-menu-item" id="dashboard">
              <a href="<?php echo ADMINURL?>view_customer">
                <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                <span class="site-menu-title">Customers</span>
              </a>  
            </li>

          </ul>            
        </div>
      </div>
    </div>
</div>