<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mb-3">

            <?php if (session_has('fail')) : ?>
                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                    <strong>Fail!</strong> <?php echo session_get('fail'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php session_del('fail');
            endif; ?>

            <div class="card">
                <div class="card-header">
                    Add your money!
                </div>
                <div class="card-body">
                     <form action="<?php echo url('wallet/store') ?>" method="post">
                        <div class="form-group">
                            <label>Currency</label>
                            <br>
                            
                            <select id="currency" name="currency">
                                 <?php 
                                
                                foreach($currencyBase as $values)
                                {
                                    
                                    echo '<option value="'.$values['currency'].'">'.($values['currency']) .'</option>';
                                    
                                }

                                ?>
  

                            </select>   
                          <!--  <input type="text" class="form-control" name="currency" id="currency"> -->
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" step="0.01" class="form-control" name="amount" id="amount">
                        </div>
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price">
                        </div>
                        <button type="submit" class="btn btn-primary"> Create </button>
                        <a href="<?php echo url('wallet') ?>" class="btn btn-secondary"> Back </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>