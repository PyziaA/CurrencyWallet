<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
    <div class="container">
        <a class="navbar-brand" href="<?php echo url('/') ?>">E-wallet
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        
            <ul class="navbar-nav ml-auto">
                        
                <li class="nav-item text-white pt-2 pr-2"><?php if(session_has('user_name'))
                {?>
                    <i class="fa-solid fa-user"></i> Hello <?php
                echo (session_get('user_name'));
                }
                ?>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('wallet') ?>">Wallet</a>
                </li>
                <?php if(session_has('user_id')) : ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('user/logout') ?>">Logout</a>
                    </li>
                <?php else : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('user/register') ?>">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('user/login') ?>">Login</a>
                </li>

                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>