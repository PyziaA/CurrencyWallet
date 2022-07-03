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
    <div class="card card-header mb-5">
        <h4>Last currency added: <span class="font-weight-bold"><?php echo $lastCurrency['currency']; ?></span></h4>
    </div>
    <div class="row mb-3">
        <div class="col-md-8">
            <h3>All money:</h3>
        </div>
        <div class="col-md-4">
            <a href="<?php echo url('wallet/create') ?>" class="btn btn-primary float-right">
                <i class="fas fa-plus-circle"></i> Create
            </a>
        </div>
    </div>
    <div class="row mb-3 table-responsive-md">

        <div class="col-md-12 mb-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <div>ID</div>
                        </th>
                        <th scope="col">
                            <div>Currency</div>
                        </th>
                        <th scope="col">
                            <div>Amount</div>
                        </th>
                        <th scope="col">
                            <div>Price</div>
                        </th>
                        <th scope="col">
                            <div></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wallets as $wallet) : ?>
                        <tr>
                            <th scope="row" class="align-middle">
                                <?php echo $wallet['id']; ?>
                            </th>
                            <td class="align-middle">
                                <?php echo $wallet['currency']; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $wallet['amount']; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $wallet['price']; ?>
                            </td>
                            <td class="text-right align-middle">
                                <a href="<?php echo url('wallet/edit/' . $wallet['id']); ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo url('wallet/delete/' . $wallet['id']); ?>" class="btn btn-danger">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($start) && isset($total)) pagination($total, $count, 'wallet');
            ?>
        </div>
    </div>
</div>