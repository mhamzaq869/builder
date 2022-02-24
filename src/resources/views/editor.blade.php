@extends('Builder::visualBuilder.master')

@section('vuContent')
    @if ($temp)
        {!! $temp->content !!}
    @else
    <header>
        <h1>Hello World</h1>
    </header>
    @endif

@endsection

@section('vuScript')
    <script>
        cmdm.add('save-db', function() {
        var InnerHtml =  editor.getHtml() + '<style>' + editor.getCss()  + '</style>';

            $.post("{{route('template.store.design')}}", {_token:"{{csrf_token()}}",html: InnerHtml,id:"{{$temp->id}}"}, function (result) {
                if(result.status == 200){
                    toastr.success(result.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

                if(result.status == 400){
                    toastr.error(result.message,{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

            });
        });
    </script>
@endsection
