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
                    <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="temp_id" id="templateActive">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="border pb-3 container">
                                    <span class="heading-forth ">Page title</span>
                                    <div class="input-serachs mt-2">
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Home">
                                    </div>
                                    <br />
                                    <span class="heading-forth">Description </span>
                                    <textarea cols="" id="editor1" name="decription" rows=""> </textarea>
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
                                        <input type="text" hidden name="page_url" id="slug1"
                                            placeholder="http://www.tutorvy.com/blog/Accessibility">
                                        <input type="text" class="form-control" id="slug2"
                                            placeholder="http://www.tutorvy.com/blog/Accessibility">
                                    </div>
                                </div>



                                <span class="heading-forth "> Meta title </span>
                                <div class="input-serachs mt-2">
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        placeholder="Accessibility ideas for distance learning during COVID-19">

                                </div>
                                <span class="heading-forth ">Meta description</span>
                                <div class="input-serachs mt-2">
                                    <textarea class="form-control texteara-s" name="meta_description"
                                        id="exampleFormControlTextarea1" rows="3">

                                    </textarea>
                                </div>

                                <span class="heading-forth ">Meta keyword</span>
                                <input type="text" name="keywords" id="tags" class="form-control" placeholder="">
                                <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter
                                    key</small>


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
    <script>

        CKEDITOR.replace('editor1', {
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Start typing here...'
        });

        $("#title").on('keyup', function() {
            var slug = window.location.origin + '/page/' + slugify(this.value);
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

    </script>
@endsection
