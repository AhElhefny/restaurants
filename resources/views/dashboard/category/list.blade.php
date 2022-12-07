<x-dashboard.layouts.master title="{{__('dashboard.category list')}}">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <x-dashboard.layouts.breadcrumb now="{{__('dashboard.category list')}}">
        </x-dashboard.layouts.breadcrumb>
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('dashboard.category list')}}</h4>
                </div>

                @if(\Session::get('success'))
                    <x-dashboard.layouts.message />
                @endif
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive overflow-auto">
                            <table class="table table-striped " id="categories-table">

                                <thead>
                                @can('add category')
                                <a href="{{route('admin.category.create')}}"><button  class="mb-2 btn btn-primary"><i class="mr-1 feather icon-plus"></i>{{__('dashboard.add category')}}</button></a>
                                @endcan
                                <tr>
                                    <th>{{__('dashboard.table name')}}</th>
                                    <th>{{__('dashboard.table description')}}</th>
                                    <th>{{__('dashboard.table image')}}</th>
                                    <th>{{__('dashboard.table status')}}</th>
                                    <th>{{__('dashboard.table create date')}}</th>
                                    <th>{{__('dashboard.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class=" ">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </dev>
    </div>
</div>
<!-- END: Content-->
@section('script')
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--    <script src="{{asset('dashboardAssets/assets/js/arabicFont.js')}}"></script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>

            // window.jsPDF = window.jspdf.jsPDF;
            // window.html2canvas = html2canvas;
            $(document).ready(function () {
                $('#categories-table').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"category",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order : [[2,'desc']],
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'description', name:'description'},
                        {data:'image',render:function(data){
                          return  `<img width="100" height="80" src="${data}">`
                        }},
                        {data: 'active', render:function(data){
                            return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                        }},
                        {data: 'created_at', name:'created_at'},
                        {data: 'id',
                            render:function (data,two,three){
                                let edit ='category/'+data+'/edit';
                                let changeStatus ='category/'+data+'/changeStatus';
                                @if(auth()->user()->can('edit category'))
                               return `<div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('dashboard.actions')}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                            <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                            <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                        </div>
                                    </div>
                                </div>`;
                            @endcan
                                return ''
                            }
                        },
                    ]
                });

                // $('.himasami').on('click',function (){
                //     var element = document.getElementById('categories-table');
                //     var opt = {
                //         margin:       0.05,
                //         filename:     'categories.pdf',
                //         image:        { type: 'jpeg', quality: 0.98 },
                //         html2canvas:  { scale: 2 },
                //         jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
                //     };
                //     html2pdf().set(opt).from(element).save();
                // });

                // function demoFromHTML() {
                //     var pdf = new jsPDF('p', 'pt', 'letter');
                //     source = $('#customers')[0];
                //     specialElementHandlers = {
                //         '#bypassme': function (element, renderer) {
                //             return true
                //         }
                //     };
                //     margins = {
                //         top: 80,
                //         bottom: 60,
                //         left: 10,
                //         width: 700
                //     };
                //     pdf.fromHTML(
                //         source, // HTML string or DOM elem ref.
                //         margins.left, // x coord
                //         margins.top, { // y coord
                //             'width': margins.width, // max width of content on PDF
                //             'elementHandlers': specialElementHandlers
                //         },
                //         function (dispose) {
                //             pdf.save('Test.pdf');
                //         }, margins);
                // }
            });
        </script>
@endsection
</x-dashboard.layouts.master>
