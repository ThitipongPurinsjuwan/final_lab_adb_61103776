<!-- Start Content-->
<div class="container-fluid">
    <!-- Alert box -->
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <i class="dripicons-checkmark mr-2"></i> your product <strong>success added</strong> .
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('false_insert_product_bill')) { ?>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <i class="dripicons-wrong mr-2"></i> your product <strong>false</strong> to add in <strong> productl </strong> collection.
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('false_insert_product')) { ?>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <i class="dripicons-wrong mr-2"></i> your product <strong>false</strong> to add in <strong> product_bill </strong> collection.
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('add_quntity_false')) { ?>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <i class="dripicons-wrong mr-2"></i> your product <strong>false</strong> to add quntity in <strong> product </strong> collection.
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('add_quntity_success')) { ?>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <i class="dripicons-wrong mr-2"></i> your product <strong>success</strong> to add quntity in <strong> product </strong> collection.
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- End alert box -->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                        <li class="breadcrumb-item active">Stock</li>
                    </ol>
                </div>
                <h4 class="page-title">Stock</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <a class="btn btn-danger mb-2 text-white" data-toggle="modal" data-target="#add_product"><i class="mdi mdi-plus-circle mr-2"></i> Add Products</a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <button name="search" id="search" type="submit" value="search" class="btn btn-info"><i class="fas fa-search"></i> Search</button>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <a href="<?php echo base_url('main_hci/cart') ?>" name="cart" id="cart" value="cart" class="btn btn-block btn-primary text-white"> Cart (<?php //echo count($carts) ?>)</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th style="width: 125px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $r) { ?>
                                    <tr>
                                        <td><?php echo $r['name'] ?></td>
                                        <td><?php echo $r['price'] ?></td>
                                        <td>
                                            <h3><a href="<?php echo base_url('main_hci/addCart') ?>"><i class="uil uil-plus"></i></a></h3>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- container -->

</div> <!-- content -->