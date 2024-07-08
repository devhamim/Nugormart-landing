<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Landing Page List</h1>
            <p class="breadcrumbs"><span><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Landing Page
            </p>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Link</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="https://cottonbd.nitebiz.com/black/dress">https://cottonbd.nitebiz.com/black/dress</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="https://cottonbd.nitebiz.com/landing/page">https://cottonbd.nitebiz.com/landing/page</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="https://cottonbd.nitebiz.com/putul/dress">https://cottonbd.nitebiz.com/putul/dress</a></td>
                                </tr>
                                
                                <tr>
                                    <td>4</td>
                                    <td><a href="https://cottonbd.nitebiz.com/batik/dress">https://cottonbd.nitebiz.com/batik/dress</a></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><a href="https://cottonbd.nitebiz.com/premium/dress">https://cottonbd.nitebiz.com/premium/dress</a></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><a href="https://cottonbd.nitebiz.com/fotula">https://cottonbd.nitebiz.com/fotula</a></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><a href="https://cottonbd.nitebiz.com/premium/tiya">https://cottonbd.nitebiz.com/premium/tiya</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\all project\batikcloth_fashiongallery\resources\views/backend/landingpage.blade.php ENDPATH**/ ?>