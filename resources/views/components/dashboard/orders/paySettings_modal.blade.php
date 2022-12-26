@php use App\Models\OrderStatus;use App\Models\PaymentMethod; @endphp
<div class="modal fade text-left" id="changePaySettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">{{__('dashboard.payment')}} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" id="modal-pay-settings-form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label
                            for="first-name-icon">{{__('dashboard.payment method')}}</label>
                        <select name="payment_method_id" id="sub-category"
                                class="select2 form-control">
                            <optgroup label="{{__('dashboard.choose one')}}">
                                @foreach(PaymentMethod::all() as $method)
                                    <option value="{{$method->id}}">{{$method->method}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label
                            for="first-name-icon">{{__('dashboard.payment status')}}</label>
                        <select name="payment_status" id="sub-category"
                                class="select2 form-control">
                            <optgroup label="{{__('dashboard.choose one')}}">
                                <option value="0">{{__('dashboard.un-paid')}}</option>
                                <option value="1">{{__('dashboard.paid')}}</option>
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
