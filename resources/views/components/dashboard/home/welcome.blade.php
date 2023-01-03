<div class="col-lg-6 col-md-12 col-sm-12">
    <div class="card bg-analytics text-white">
        <div class="card-content">
            <div class="card-body text-center">
                <img
                    src="{{asset('dashboardAssets/app-assets/images/elements/decore-left.png')}}"
                    class="img-left" alt="card-img-left">
                <img
                    src="{{asset('dashboardAssets/app-assets/images/elements/decore-right.png')}}"
                    class="img-right" alt="card-img-right">
                <div class="avatar avatar-xl bg-primary shadow mt-0">
                    <div class="avatar-content">
                        <i class="feather icon-award white font-large-1"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-2 text-white">{{__('dashboard.welcome').' ' . auth()->user()->name}} </h1>
                    <p class="m-auto w-75">{{__('dashboard.welcome sentence')}}</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
