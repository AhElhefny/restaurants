<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Dispatched Orders</h4>
            </div>
            <div class="card-content">
                <div class="table-responsive mt-1">
                    <table class="table table-hover-animation mb-0">
                        <thead>
                        <tr>
                            <th>{{__('dashboard.order_number')}}</th>
                            <th>{{__('dashboard.order status')}}</th>
                            <th>{{__('dashboard.services')}}</th>
                            <th>{{__('dashboard.order user')}}</th>
                            <th>{{__('dashboard.total price')}}</th>
                            <th>{{__('dashboard.branch')}}</th>
                            <th>{{__('dashboard.payment status')}}</th>
                            <th>{{__('dashboard.table create date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->take(5) as $order)
                                <tr>
                                    <td>#{{$order->order_number}}</td>
                                    <td>
                                        @if($order->order_status_id == \App\Models\Order::FINISHED)
                                            <i class="fa fa-circle font-small-3 text-success mr-50"></i>
                                        @elseif($order->order_status_id == \App\Models\Order::CANCELED)
                                            <i class="fa fa-circle font-small-3 text-danger mr-50"></i>
                                        @else
                                            <i class="fa fa-circle font-small-3 text-warning mr-50"></i>
                                        @endif

                                        {{$order->orderStatus->name}}
                                    </td>
                                    <td class="p-1">
                                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                            @foreach($order->services as $service)
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-placement="bottom" data-original-title="{{$service->name}}"
                                                    class="avatar pull-up">
                                                    <img class="media-object rounded-circle"
                                                         src="{{$service->image}}"
                                                         alt="Avatar" height="30" width="30">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$order->user->name}}</td>
                                    <td>
                                        <span>{{$order->total_after_discount_and_tax.' '.__('dashboard.SAR')}}</span>
                                        <div class="progress progress-bar-success mt-1 mb-0">
                                            <div class="progress-bar" role="progressbar" style="width: {{($order->total_after_discount_and_tax*100)/1000}}%"
                                                 aria-valuenow="80" aria-valuemin="0"
                                                 aria-valuemax="1000"></div>
                                        </div>
                                    </td>
                                    <td>{{$order->branch->name}}</td>
                                    <td>{{$order->payment_status == 1 ? __('dashboard.paid'):__('dashboard.un-paid')}}</td>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
