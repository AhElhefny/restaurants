<x-dashboard.layouts.master title="{{__('dashboard.order details')}}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.order details')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">{{__('dashboard.orders list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="content-body">
                <section id="content-types">
                    <div class="row match-height">
                        <div class="col-xl-4 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">{{__('dashboard.order items')}}</h4>
                                    </div>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach($order->orderItems as $key=>$item)
                                            <li data-target="#carousel-example-generic" data-slide-to="{{$key}}"></li>
                                            @endforeach
                                        </ol>

                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img src="{{$order->services[0]->image}}" class="d-block w-100" height="250px" alt="1 slide">
                                            </div>
                                            @foreach($order->services as $key=>$service)
                                                @if($key != 0)
                                                    <div class="carousel-item">
                                                        <img src="{{$service->image}}" class="d-block w-100" height="250px" alt="{{$service->id}} slide">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach($order->services as $key => $service)
                                            <li class="list-group-item text-center">
                                                <span class="badge badge-pill bg-{{$key%2==0?'info':'warning'}} float-right">{{$service->pivot->price . ' ' . __('dashboard.SAR')}}</span>
                                                <span>{{$order->sizes[$key]->name}}</span>
                                                <span class="float-left">{{$service->name}}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card h-auto">
                                <div class="card-header mb-1">
                                    <h4 class="card-title">{{__('dashboard.order details')}}</h4>
                                </div>
                                <div class="card-content h-auto">
                                    <div class="card-body">
                                        <table class="w-100 h-100" style="border-collapse: separate; border-spacing: 0 12px;">
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.order_number')}} :</p></td>
                                                <td><p class="card-text">{{'#'.$order->order_number}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.table status')}} :</p></td>
                                                <td><p class="card-text">{{$order->orderStatus->name}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.payment method')}} :</p></td>
                                                <td><p class="card-text">{{$order->paymentMethod->method}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.delivery type')}} :</p></td>
                                                <td><p class="card-text">{{$order->deliveryType->type}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.payment status')}} :</p></td>
                                                <td><p class="card-text">{{$order->payment_status == 0?__('dashboard.un-paid'):__('dashboard.paid')}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.order user')}} :</p></td>
                                                <td><p class="card-text">{{$order->user->name}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><p class="card-text">{{__('dashboard.branch')}} :</p></td>
                                                <td><p class="card-text">{{$order->branch->name}}</p></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <span class="float-left">{{__('dashboard.table create date')}} :</span>
                                    <span class="float-right">{{$order->created_at}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card h-auto">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">{{__('dashboard.Price Details')}}</h4>
                                    </div>
                                    <hr/>
                                    <table class="w-100" style="border-collapse: separate; border-spacing: 10px 12px; ">
                                        <tr>
                                            <td class="text-muted">{{__('dashboard.sub total')}}</td>
                                            <td style="text-align:end;">{{$order->total_before_discount_and_tax}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{__('dashboard.coupon_discounts')}}</td>
                                            <td style="text-align:end;"> -  {{$order->coupon_discounts}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">{{__('dashboard.table tax')}}</td>
                                            <td style="text-align:end;"> +  {{$order->tax}} %</td>
                                        </tr>
                                    </table>
                                    <hr/>
                                    <div class="detail">
                                        <div class="detail-title detail-total d-inline-block float-left m-2"><strong>{{__('dashboard.total price')}}</strong></div>
                                        <div class="detail-amt total-amt d-inline-block float-right m-2">{{$order->total_after_discount_and_tax}}</div>
                                    </div>
                                    <a class="btn btn-primary btn-block m-1" href="{{route('admin.orders.invoice',$order->id)}}" target="_blank" style="width: 94%">{{__('dashboard.invoice')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
</x-dashboard.layouts.master>
