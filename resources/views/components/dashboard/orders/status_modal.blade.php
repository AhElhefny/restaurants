@php use App\Models\OrderStatus; @endphp
<div class="modal fade text-left" id="changeOrderStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">{{__('dashboard.change status')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" id="modal-change-state-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label
                            for="first-name-icon">{{__('dashboard.order-status')}}</label>
                        <select name="order_status" id="sub-category"
                                class="select2 form-control">
                            <optgroup label="{{__('dashboard.choose one')}}">
                                @foreach(OrderStatus::all() as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        {{__('dashboard.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
