@extends('Builder::layouts.app')

@section('content')
    <style>
        .image {
            overflow: hidden;
            height: 212px;
            width: 375px;
            position: relative;
            cursor: pointer;
            margin: 0 15px;
            box-shadow: 0 0 25px 1px rgba(0, 0, 0, .3);
            transition: .5s;
            background-color: #555
        }

        .image:after {
            content: '';
            position: absolute;
            z-index: 1;
            top: 50%;
            left: 50%;
            width: 500px;
            height: 500px;
            transform: translate(-140%, -50%);
            background-color: rgb(172, 172, 175);
            opacity: 0.8;
            border-radius: 50%;
            transition: .8s
        }

        .image:hover:after {
            transform: translate(-50%, -50%)
        }

        .image:hover img {
            transform: translate(-50%, -50%) scale(1.3) rotate(20deg)
        }

        .image>img {
            position: absolute;
            height: 110%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: .8s
        }

        .icon {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 50%;
            transform: translate(-2000px, -50%);
            color: #fff;
            transition: .8s;
            transition-timing-function: ease-in
        }

        .image:hover .icon {
            transform: translate(-50%, -50%);
            transition-timing-function: ease
        }

    </style>
    <section id="homesection" style="display: flex;z-index: -1;">
        <div class="container-fluid mt-4">
            <div class="row ml-1 mr-1 sampleTemplates">
                <div class="col-md-12 mb-3">
                    <h3>Page templates</h3>
                </div>

                <div class="text-center col-md-4">
                    <a href="#addTemplate"  data-toggle="modal" class="new">
                        <img src="https://riotlysocialmedia.com/wp-content/uploads/2017/11/icon-post.jpg" alt="create" class="mb-4">
                    </a>
                </div>
                @foreach ($templates as $temp)
                    <div class="col-md-4">
                        <div class="image">
                            <img src="{{ asset($temp->picture) }}" class="w-100 mb-4">
                            <span class="icon ">
                                <a href="#addTemplate" class="text-white" onclick="editTemp({{$temp->id}})"><i class="fa fa-edit fa-2x"></i></a>
                                <a href="{{route('template.design',[$temp->id])}}" class="text-white"><i class="fa fa-paint-brush fa-2x mr-3"></i></a>
                            </span>
                        </div>
                        <p class="heading-forth text-center mt-4">{{ $temp->title }}</p>
                    </div>

                @endforeach

                <div class="modal fade supportModal" id="addTemplate" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content pb-3">
                            <div class="modal-body">
                                <div class="container">
                                    <form action="{{ route('template.store') }}" class="tempForm"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 pt-4">
                                                <h4>Create Template</h4>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="heading-forth ">Title</span>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    placeholder="Template 1">
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <span class="heading-forth ">Thumbnail</span>
                                                <input type="file" name="thumbnail" data-default-file="" id="thumbnail" class="dropify">
                                            </div>
                                            <div class="col-md-12 mt-2 text-right">
                                                <button type="submit" class="btn btn-primary"
                                                    style="width: 130px;">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>

        var data = [];

        window.onload = $.ajax({
            url: "{{route('template.show')}}",
            type: "get",
            success: function (res) {
                if(res.status == 200){
                    data = res.data
                }
            }
        });

        $(".new").click(function(){
            $('.tempForm').attr('action',"{{ route('template.store') }}")
            $('#title').val('');
        });

        function editTemp(id){
            $("#addTemplate").modal('show');
            var record = data.find(val => val.id == id);
            $("#title").val(record.title);
            $('.tempForm').attr('action',"/template/"+id+"/update")
        }


    </script>
@endsection
