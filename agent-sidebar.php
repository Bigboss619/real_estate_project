<div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item <?php if($cur_page == 'agent-dashboard.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-dashboard">Dashboard</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-payment-section.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-payment">Make Payment</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-orders.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-order">Orders</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-property-add.php' || $cur_page == 'agent-photo-gallery.php' || $cur_page == 'agent-video-gallery.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-property-add">Add Property</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-properties.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-property">All Properties</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-messages.php' || $cur_page == 'agent-message-create.php' || $cur_page == 'agent-message.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-messages">Messages</a>
                </li>
                <li class="list-group-item <?php if($cur_page == 'agent-edit-profile.php') {echo 'active';} ?>">
                    <a href="<?php echo BASE_URL; ?>agent-edit-profile">Edit Profile</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo BASE_URL; ?>agent-logout">Logout</a>
                </li>
            </ul>
        </div>