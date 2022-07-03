<div class="container mt-5">
    <div class="row bm-3">
        <div class="col-md-12">
            <?php if (session_has('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> <?php echo session_get('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_del('success');
            endif; ?>
        </div>
    </div>
    <div class="d-flex justify-content-center ">
        <h4 class="text-center mb-5 w-25 p-2 border border-header rounded bg-light">
            <?php if ($profitLose >= 0) : ?>
                <span class="text-success text-sm">
                    Profit:</br>
                    <i class="fa-solid fa-arrow-up"> </i> <?php echo ($profitLose); ?></br></span>
            <?php endif; ?>
            <?php if ($profitLose < 0) : ?>
                <span class="text-danger text-sm">
                Loss:</br>
                <i class="fa-solid fa-arrow-down"> </i> <?php echo ($profitLose); ?></br></span>
            <?php endif; ?>
        </h4> 
        
    </div>
    <div>
        <h4 class="card card-header">Value of cash held at the date of purchase:</h4>
        <div class="row">
            <?php foreach ($cashNotAct as $code => $value) : ?>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mt-4 mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold"><?php echo ($code); ?></p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo ($value) . '<br />'; ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="border border-1 rounded border-radius-1 bg-primary text-center pt-1 pb-1">
                                        <i class="fas fa-regular text-white fa-wallet fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div>
        <h4 class="card card-header">Value of cash held today (profit/loss):</h4>
        <div class="row">
            <?php foreach ($cashAct as $name => $walletValue) : ?>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mt-4 mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold"><?php echo ($name); ?></p>
                                        <h5 class="font-weight-bolder mb-0">
                                            <?php echo (round($walletValue, 2)); ?></h5>
                                        <h6>
                                            <?php if ($substract[$name] >= 0) : ?>
                                                <span class="text-success text-sm">
                                                    (+<?php echo ($substract[$name]); ?>)</br></span>
                                            <?php endif; ?>
                                            <?php if ($substract[$name] < 0) : ?>
                                                <span class="text-danger text-sm">
                                                    (<?php echo ($substract[$name]); ?>)</br></span>
                                            <?php endif; ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="border border-1 rounded border-radius-1 bg-primary text-center pt-1 pb-1">
                                        <i class="fas fa-regular text-white fa-wallet fa-2x "></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>