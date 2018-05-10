
<?php $__env->startSection('content'); ?>
<div id="content" class="rst-main-content rst-content-full">
  <br />
  <br />
  <div class="text-center">
    <h3><?php echo e(trans('interface.best_dishes')); ?></h3>
  </div>
  <div class="container">
    <div class="row">
<?php foreach($services as $value): ?>
      <div class="col-sm-4">
        <div class="rst-dishes-item">
          <div class="rst-thumbnail">
            <a href="#">
              <img class="img-responsive" src="<?php echo e(asset('/uploads/thumb_'.$Service_m->getServiceMineImages($value->id)->image )); ?>" alt="" />
              <span class="rst-price"><?php echo e($value->price); ?></span>
            </a>
          </div>
          <h3> <?php echo e(trans('interface.'.$value->codeTitle)); ?> </h3>
          <p>
            <?php echo e(trans('interface.'.$value->description)); ?>

          </p>
          <a href="#" class="btn btn-danger btn-lg">Add to cart</a>
        </div>
      </div>
<?php endforeach; ?>
    </div>
  </div>
  <div class="rst-dishes" data-background="<?php echo e(asset('/assets/front/img/post/bg_dishes.jpg')); ?>">
    <div class="rst-dishes-form clearfix">
      <div class="rst-table">
        <div class="rst-table-row">
          <div class="rst-img-dishes rst-table-cell">
            <img src="<?php echo e(asset('/uploads/thumb_'.$Service_m->getServiceMineImages($service->id)->image )); ?>" alt="" />
          </div>
          <div class="rst-dishes-content rst-table-cell">
            <h3> <?php echo e(trans('interface.'.$service->codeTitle)); ?> <?php echo e($service->price); ?></h3>
            <div class="row">
              <div class="col-sm-12">
                <div class="rst-dishes-action">
                  <h4><a href="#"><?php echo e(trans('interface.'.$service->codeTitle)); ?></a></h4>
                  <span class="rst-price"> <?php echo e($service->price); ?></span>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-lg btn-success">Browse menu</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <br /><br /><hr /><br /><br />
    <div class="container"><!--- container -->
      <div class="row"><!--- row -->
        <div class="col-sm-6">
          <h3><?php echo e(trans('interface.about')); ?></h3>
          <p><?php echo e(trans('interface.aboutDesc')); ?> </p>
        </div>
        <div class="col-sm-6">
          <h3><?php echo e(trans('interface.happy_hours')); ?></h3>
          <div class="rst-happy-hours">
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.monday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock in-stock" data-original-title="In stock" data-placement="bottom" data-toggle="tooltip"></span> 07.00 — 23.00</div>
            </div>
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.thuesday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock in-stock" data-original-title="In stock" data-placement="bottom" data-toggle="tooltip"></span> 07.00 — 21.00</div>
            </div>
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.wednesday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock low-stock" data-original-title="Low stock" data-placement="bottom" data-toggle="tooltip"></span> 18.00 — 21.00</div>
            </div>
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.thurstday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock low-stock" data-original-title="Low stock" data-placement="bottom" data-toggle="tooltip"></span> 18.00 — 22.00</div>
            </div>
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.friday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock in-stock" data-original-title="In stock" data-placement="bottom" data-toggle="tooltip"></span> 07.00 — 22.00</div>
            </div>
            <div class="clearfix rst-happy-date">
              <div class="pull-left date"><?php echo e(trans('interface.saturday')); ?></div>
              <div class="pull-right hours"><span class="rst-stock low-stock" data-original-title="Low stock" data-placement="bottom" data-toggle="tooltip"></span> 18.00 — 24.00</div>
            </div>
          </div>
        </div>
      </div>
    </div><!--- end row -->
    <!--- Contact Detail/Map -->
    <div class="rst-contact">
      <div id="map-canvas" class="rst-contact-maps" data-zoom="15" data-center="10.731688,122.5505356"> </div>
      <div class="rst-opacity"></div>
      <div class="rst-contact-add">
        <h3><?php echo e(trans('interface.where_are_we')); ?> </h3>
        <div class="rst-address">
          <i class="fa fa-map-marker"></i>
          <select name="" class="rst-drop-location">
            <option value="Street 15, Manhattan, New York">USA</option>
            <option value="Street 115, India">India</option>
            <option value="Street 253, Russia">Russia</option>
          </select>
          <div class="address">Street 15, Manhattan, New York</div>
        </div>
      </div>
    </div><!--- end Contact Detail/Map -->
  </div><!--- end container -->

</div><!--- End Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>