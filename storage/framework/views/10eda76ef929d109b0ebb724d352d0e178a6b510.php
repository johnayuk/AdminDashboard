

        <nav class="navbar navbar-expand-sm navbar-light bg-dark">
            <div class="container">

                <!--tips: to change the nav placement use .fixed-top,.fixed-bottom,.sticky-top-->
                <a class="navbar-brand" href="/">ALPHA-HMS</a>
                <!--<a class="navbar-brand" href="#">
                <img src="..." class="d-inline-block align-top" width="30" height="30" alt="...">My Brand
            </a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

             
           
            <?php if(Route::has('login')): ?>
            <div class="top-right links">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/home')); ?>">Home</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>">Login</a>

                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
       
        </nav>
                    

<section id="landing-hero">
    <div class="container">
<div class="row justify-content-center align-items-center" style="height: 60vh">
    <div class="col-md-7 m-auto">
        <small class="d-block text-center">WELCOME TO</small>
        <h1 class="display-4 text-center">ALPHA HMS</h1>
<a href="<?php echo e(route('login')); ?>" class="d-block m-auto mt-4 btn" style="width: 60%; background-color:#007bff">Continue to app</a>
    </div>

        </div>
    </div>
</section>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Documents\A practical web development files\laravel work\ProjectCreate-HMS\resources\views/welcome.blade.php ENDPATH**/ ?>