        <!-- Start Product Grid -->
        <section class="htc__product__grid bg__white ptb--100">
            <div class="container">
                <h2>สร้างสินค้า</h2>
                <hr>
                <form method="post" action="<?php echo base_url('products/save') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ชื่อสินค้า</label><span class="text-danger">*</span>
                                <input name="name" type="text" class="form-control" placeholder="ชื่อสินค้า" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ราคา/ชิ้น</label><span class="text-danger">*</span>
                                <input name="price" type="number" class="form-control" placeholder="ราคา" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>หมวดหมู่</label><span class="text-danger">*</span>
                                <select class="form-control" name="categories" required>
                                    <option value="">เลือกหมวดหมู่</option>
                                    <?php foreach ($categories as $key => $row) { ?>
                                        <option value="<?php echo $row['_id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"><i class="far fa-save"></i> บันทึก</button>
                    </div>
                </form>
            </div>
        </section>