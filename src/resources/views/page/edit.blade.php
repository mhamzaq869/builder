@extends('Builder::layouts.app')

@section('content')
<section id="homesection" style="display: flex;z-index: -1;">

    <div class="container-fluid mt-4">
        <div class="row ml-1 mr-1">
            <div class="col-md-6">
                <h1>
                    Add Page
                </h1>
            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('page.update',[$page->id])}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                <div class="col-md-9">
                    <div class="border pb-3 container">


                        <span class="heading-forth ">Page title</span>
                        <div class="input-serachs mt-2">
                            <input type="text" class="form-control" name="title" id="title" value="{{$page->title ?? ''}}" placeholder="Home">
                        </div>
                        <br />
                        <span class="heading-forth">Description </span>
                             <textarea cols="" id="editor1"  name="decription" rows=""> {{$page->decription ?? ''}}</textarea>
                    </div>

                    <div class="container border mt-3">
                        <h3 class="mt-2">Templates</h3>
                        <div class="row">
                            @foreach ($templates as $temp)
                            <div class="col-md-4" onmouseover="moseover({{$temp->id}})" onmouseout="mouseout({{$temp->id}})">
                                <div class="card position-relative text-left template-card" style="width: 18rem;">
                                    <img class="card-img-top h-25" style="filter:brightness(0.5)" src="{{asset($temp->picture ?? '')}}" alt="Card image cap">
                                    <div class="image-overlay"></div>
                                    <div class="card-body position-absolute mt-5 w-100 d-none" id="card-hover-{{$temp->id}}">
                                      <h5 class="card-title text-white ">{{ucfirst($temp->title)}}</h5>

                                      <div class="row text-left">
                                          <div class="col-md-6">
                                              @if ($temp->page_id == $page->id)
                                              <button type="button" class="btn btn-sm btn-success">Activated</button>
                                              @else
                                                <button type="button" onclick="activateTemplate({{$page->id}},{{$temp->id}})" id="activate_{{$temp->id}}" class="btn btn-sm btn-primary">Activate</button>
                                                <button class="btn btn-primary disabled d-none" id="process_{{$temp->id}}">
                                                    <div class="d-flex">
                                                        <div class="spinner-border mt-1 mr-1" style="width: 1rem; height:1rem" role="status">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                        Processing
                                                    </div>
                                                </button>
                                              @endif

                                          </div>
                                      </div>

                                    </div>
                                </div>


                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-md-3 border">
                    <div class="container m-0 p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="mt-4">Page details</h3>
                            </div>

                        </div>

                    </div>



                    <div class="mt-3">
                        <span class="heading-forth ">Page URL</span>
                        <div class="input-serachs mt-2">
                            <input type="text" hidden name="page_url" value="{{$page->page_url ?? ''}}" id="slug1" placeholder="http://www.tutorvy.com/blog/Accessibility">
                            <input type="text" class="form-control" id="slug2" value="{{route('page',[$page->page_url])}}" placeholder="http://www.tutorvy.com/blog/Accessibility">
                        </div>
                    </div>



                    <span class="heading-forth "> Meta title </span>
                    <div class="input-serachs mt-2">
                        <input type="text" class="form-control" value="{{$page->meta_title ?? ''}}" id="meta_title" name="meta_title" placeholder="Accessibility ideas for distance learning during COVID-19">

                    </div>
                    <span class="heading-forth ">Meta description</span>
                    <div class="input-serachs mt-2">
                        <textarea class="form-control texteara-s" name="meta_description" id="exampleFormControlTextarea1" rows="3">{{$page->meta_description ?? ''}}</textarea>
                    </div>

                    <span class="heading-forth ">Meta keyword</span>
                    <input type="text" name="keywords" id="tags" value="{{$page->keywords ?? ''}}" class="form-control" placeholder="">
                    <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>


                    <div class="text-right mt-3 mb-3">
                        <button class="btn btn-outline-primary">Cancel</button>
                        <button class="btn btn-primary w-50">Save changes</button>

                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.16.1/standard-all/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        CKEDITOR.replace('editor1', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Start typing here...'
        });

        $("#title").on('keyup',function(){
           var slug =  window.location.origin +'/page/'+slugify(this.value);
           $("#slug1").val(slugify(this.value))
           $("#slug2").val(slug)
           $("#meta_title").val(this.value)
        });


        function slugify(string) {
            return string
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        }

        function moseover(id){
            $("#card-hover-"+id).removeClass('d-none')
        }

        function mouseout(id){
            $("#card-hover-"+id).addClass('d-none')
        }

        function activateTemplate(page,id){
            $("#activate_"+id).addClass('d-none');
            $("#process_"+id).removeClass('d-none');
            callAjax(page,id);
        }
        function callAjax(page_id,id){
            $.ajax({
                url: "{{route('template.activate')}}",
                dataType: "json",
                type: "Post",
                async: true,
                data: {_token:"{{csrf_token()}}",page_id:page_id,id:id },
                success: function (result) {
                    if(result.status == 200){
                        toastr.success(result.message,{
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $("#process_"+id).addClass('d-none');
                        $("#activate_"+id).removeClass('d-none');
                        $("#activate_"+id).text('Activated');
                    }

                    if(result.status == 400){
                        toastr.error(result.message,{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            });
        }
    </script>
@endsection
