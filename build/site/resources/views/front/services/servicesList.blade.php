@extends('front.layout.main')
@section('content')
  
    <div id="content">
    <div class="container rst-main-content">
   @foreach($serviceList as $value)
      <div class="rst-category-menu text-center">
        <h3>{{trans('interface.'.$value->codeTitle)}}</h3>
        <p class="rst-menu-description"></p>
        <div class="row">
   @foreach($value->getService as $val)
          <div class="col-sm-6">
            <div class="rst-menu-item">
              <div class="rst-menu-thumbnail"><a href="recipe_detail.html">
                 @if(!empty($service->getServiceMineImages($val->id)->image))
                    <a href="/service/{{$val->id}}" ><img src='{{"/uploads/miny_".$service->getServiceMineImages($val->id)->image}}' alt=""></a>
                @else
                    <a href="/service/{{$val->id}}" ><img src='{{"/assets/front/img/logo-advert4.jpg"}}' alt=""></a>
                @endif
              </div>
              <div class="rst-menu-info">
                <h3 class="product-title"><a href="/service/{{$val->id}}">{{trans('interface.'.$val->codeTitle)}}</a></h3>
                <p>{{$val->description}}</p>
                <div class="rst-price"><strong>{{$val->price}}</strong></div>
              </div>
            </div>
          </div>
   @endforeach
        </div>
      </div>
  @endforeach

    </div><!-- End Content -->
    
  </div>
@endsection