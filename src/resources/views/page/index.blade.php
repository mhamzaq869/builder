@extends('Builder::layouts.app')

@section('content')
    <!--section start  -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="heading-first">CMS pages</h1>
            </div>
            <div class="col-md-6 text-right">
                <h1 class="heading-first">
                    <a href="{{route('templates')}}" class="btn btn-outline-primary">Templates</a>
                    <a href="{{route('page.create')}}" class="btn btn-primary">Create Page</a>
                </h1>
            </div>

            <div class="col-md-12">
                <table class="table table-dark table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">Sr no.</th>
                            <th scope="col">page title</th>
                            <th scope="col">Url</th>
                            <th scope="col">Last update</th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $i => $page)
                            <tr>
                                <td class="pt-4">{{ $i + 1 }}</td>
                                <td class="pt-4">{{ $page->title ?? '--' }}</td>
                                <td class="pt-4">{{ route('page', [$page->page_url ?? '#']) }}</td>
                                <td class="pt-4">{{ $page->updated_at->diffForHumans() ?? '--' }}</td>
                                <td class="pt-4 d-flex">
                                    <a href="{{ route('page.edit', [$page->id]) }}" class="ml-2">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    <a href="{{ route('page.delete', [$page->id]) }}" class="ml-2">
                                        <i class="fas fa-trash-alt text-white"></i>
                                    </a>
                                    {{-- <label class="switch ml-2" style="position: relative;left: -10px;width: 60px;">
                                    <input type="checkbox" class="s_status">
                                    <span class="slider round"></span>
                                </label> --}}
                                </td>
                                <td class="pt-3">
                                    <a href="{{ route('page', [$page->page_url ?? '#']) }}"
                                        class="btn btn-outline-light">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            </tbody>
            </table>
        </div>

    </div>
    <!-- end section -->
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content modals">
                <div class="modal-body modal-bodys">
                    <div class="container text-center pb-3 pt-3">
                        <img src="../assets/img/ico/cross-icon.png" alt="verfiy" />
                        <h3 class="mt-3">
                            Remove page
                        </h3>
                        <p class="paragraph-text mb-5">
                            Are you sure you want to remove page?
                        </p>

                        <button type="button" class="cencel-btn w-25" data-dismiss="modal">Cancel</button>
                        <a href="">
                            <button class="schedule-btn w-25">No</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
