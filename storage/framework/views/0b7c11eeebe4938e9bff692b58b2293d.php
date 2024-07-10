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
                                    <td><a href="https://landing.nugormart.com/karijma/stone">https://landing.nugormart.com/karijma/stone</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="https://landing.nugormart.com/batik/dress">https://landing.nugormart.com/batik/dress</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="<?php echo e(url('/landing/'. $products->slug)); ?>"><?php echo e($products->slug); ?></a></td>
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