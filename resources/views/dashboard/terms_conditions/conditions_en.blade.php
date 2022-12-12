<x-dashboard.layouts.master title="{{__('dashboard.Terms and Conditions')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.Terms and Conditions')}}">
            </x-dashboard.layouts.breadcrumb>
            <section class="full-editor">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if(\Session::get('success'))
                                <x-dashboard.layouts.message />
                            @endif
                            <div class="card-header">
                                <h4 class="card-title">{{__('dashboard.Terms and Conditions')}}</h4>
                            </div>
                                <form action="{{route('admin.terms.save')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="slug" value="terms & conditions">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="full-wrapper">
                                                        <div id="full-container">
                                                            <div class="editor">
                                                                {!! $terms->terms_en !!}
                                                            </div>
                                                        </div>
                                                        <textarea name="terms_en" class="form-control" hidden id="terms">
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="m-2 btn btn-primary" id="save">{{__('dashboard.save')}}</button>
                                </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function (){
                // var content = document.querySelector(".ql-editor").innerHTML;
                // var realContent = (content.trim) ? content.trim() : content.replace(/^\s+/,'');
                // if(realContent=='<p><br></p>'){
                //     $('#save').hide();
                // }
                $('#save').on('click',function (){
                    var content = document.querySelector(".ql-editor").innerHTML;
                    $('#terms').empty();
                    $('#terms').val(content);
                    console.log(content,$('#terms').val())
                })
            });

        </script>
    @endsection
</x-dashboard.layouts.master>
