@extends('admin.layout.base')

@section('title', 'Request History ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                @if(Setting::get('demo_mode') == 1)
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : @lang('admin.demomode')
                    </div>
                @endif
                <h5 class="mb-1">Request History</h5>
                @if(count($requests) != 0)
                    <table class="table table-striped table-bordered dataTable" id="table-4">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.request.Booking_ID')</th>
                            <th>@lang('admin.request.Admin_Name')</th>
                            <th>@lang('admin.request.Rental_Providers')</th>
                            <th>@lang('admin.request.Date_Time')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.distance')</th>
                            <th>@lang('admin.request.Payment_Mode')</th>
                            <th>@lang('admin.request.Payment_Status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $index => $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->booking_id }}</td>
                                <td>{{ $request->admin->name }}</td>
                                <td>
                                    @if($request->childs)
                                        {{ count($request->childs) }}
                                    @else
                                        0
                                    @endif
                                </td>
                                <td>
                                    @if($request->created_at)
                                        <span class="text-muted">{{$request->created_at->diffForHumans()}}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($request->childs)
                                        @php $child_status = []; @endphp
                                        @foreach($request->childs as $child_index => $child_request)
                                            @php if (!in_array($child_request->status, $child_status)) { $child_status[] = $child_request->status; } @endphp
                                        @endforeach
                                        @foreach($child_status as $ch_indx => $ch_status)
                                            @if ($ch_indx)
                                                <span>, </span>
                                            @endif
                                            <span>{{ $ch_status }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $request->distance }} {{ $request->unit }}</td>
                                <td>{{ $request->payment_mode }}</td>
                                <td>
                                    @if($request->childs)
                                        @php $child_paid = []; @endphp
                                        @foreach($request->childs as $child_index => $child_request)
                                            @php if (!in_array($child_request->paid, $child_paid)) { $child_paid[] = $child_request->paid; } @endphp
                                        @endforeach
                                        @foreach($child_paid as $ch_indx => $ch_paid)
                                            @if ($ch_indx)
                                                <span>, </span>
                                            @endif
                                            @if($ch_paid)
                                                Paid
                                            @else
                                                Not Paid
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('admin.adminrequest.show', $request->id) }}" class="dropdown-item">
                                                <i class="fa fa-search"></i> More Details
                                            </a>
                                            <form action="{{ route('admin.adminrequest.destroy', $request->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                @if( Setting::get('demo_mode') == 0)
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin.request.Booking_ID')</th>
                            <th>@lang('admin.request.Admin_Name')</th>
                            <th>@lang('admin.request.Rental_Providers')</th>
                            <th>@lang('admin.request.Date_Time')</th>
                            <th>@lang('admin.status')</th>
                            <th>@lang('admin.distance')</th>
                            <th>@lang('admin.request.Payment_Mode')</th>
                            <th>@lang('admin.request.Payment_Status')</th>
                            <th>@lang('admin.action')</th>
                        </tr>
                        </tfoot>
                    </table>
                    @include('common.pagination')
                @else
                    <h6 class="no-result">No results found</h6>
                @endif
            </div>
        </div>
    </div>
@endsection