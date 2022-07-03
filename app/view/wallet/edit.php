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
                    Edit Post
                </div>
                <div class="card-body">
                    <form action="<?php echo url('wallet/update/' . $wallet['id'] ) ?>" method="post">
                        <div class="form-group">
                            <label>Currency</label>
                            <br>
                       
                            <select id="currency" name="currency" id="currency" >
                           
                                 <?php 
                                 
                                foreach($currencyBase as $values)
                                {?>
                                    
                                   <option value=" <?php echo $values['currency'];?>" <?php if ($values['currency'] == $wallet['currency']){echo "selected";}?>>
                                   <?php echo $values['currency']?>
                                   </option>;

                                <?php }?>
                            </select>   

                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" step="0.01" class="form-control" name="amount" id="amount" value="<?php echo $wallet['amount']; ?>">   
                        </div>
                        <div class="form-group">
                            <label>Purchase price</label>
                            <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?php echo $wallet['price']; ?>">   
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?php echo url('wallet') ?>" class="btn btn-secondary"> Back </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>