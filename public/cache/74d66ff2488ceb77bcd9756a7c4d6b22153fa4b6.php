<?php $__env->startSection('content'); ?>

    <div class="page-header">
        <a href=""><h2 >List dates</h2></a>
    </div>
    <form method="POST" action="">
        <div class="form-group row navbar-right col-lg-12">
            <input type="hidden" name="csrf" id="_token" value="<?php echo e($csrft); ?>">
            <div class="container">
                <div class="row col-sm-10">
                    <div class='col-sm-3'>
                        <label for="name">Name</label><input type='text' name="name" class="form-control" id='name' />
                    </div>
                    <div class='col-sm-3'>
                        <label for="datetimepicker4">Date</label><input type='text' name="date" class="form-control" id='datetimepicker4' />
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker4').datetimepicker();
                        });
                    </script>
                </div>
                <div class="col-sm-2 float-right">
                    <button type="submit" class="btn btn-primary">Show me</button>
                </div>
            </div>
            <div class="alert alert-danger">
                <?php if($dateError != ''): ?>
                    <?php echo e($dateError); ?>

                <?php endif; ?>
                <?php if($nameError != ''): ?>
                    <p><?php echo e($nameError); ?></p>
                <?php endif; ?>
            </div>
        </div>

    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Birthday</th>
                <th>Years</th>
                <th>Days</th>
                <th>Hours</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="">
                    <td><?php echo e($date['Name']); ?></td>
                    <td><?php echo e($date['Birthdate']); ?></td>
                    <td><?php echo e($date['Years']); ?></td>
                    <td><?php echo e($date['Days']); ?></td>
                    <td><?php echo e($date['Hours']); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/znagy/workforce/views/list.blade.php ENDPATH**/ ?>