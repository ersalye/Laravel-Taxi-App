@extends('admin.layout.base')

@section('title', 'Service Types ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
           @if(Setting::get('demo_mode') == 1)
        <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : @lang('admin.demomode')
                </div>
                @endif 
            <h5 class="mb-1">Service Types</h5>
            <a href="{{ route('admin.service.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.service_type_msgs.add_new_service')</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.service.Service_Name')</th>
                    <!-- <th>@lang('admin.service.Provider_Name')</th>-->
                        <th>@lang('admin.service.Capacity')</th>
                        <th>@lang('admin.service.Type')</th>
                        <th>@lang('admin.service.Base_Price')</th>
                        <th>@lang('admin.service.Base_Distance')</th>
                        <th>@lang('admin.service.Distance_Price')</th>
                        <th>@lang('admin.service.Time_Price')</th>
                        <th>@lang('admin.service.hourly_Price')</th>
                        <th>@lang('admin.service.Price_Calculation')</th>
                        <th>@lang('admin.service.Service_Image')</th>
                        <th>@lang('admin.service.Questions')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($services as $index => $service)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $service->name }}</td>
                        <!-- <td>{{ $service->provider_name }}</td> -->
                        <td>
                            @if($service->type == 'LOAD')
                                {{ $service->weight }}, {{ $service->width }}x{{ $service->height }}
                            @else
                                {{ $service->capacity }}
                            @endif
                        </td>
                        <td>{{ $service->type }}</td>
                        <td>{{ currency($service->fixed) }}</td>
                        <td>{{ distance($service->distance) }}</td>
                        <td>{{ currency($service->price) }}</td>
                        <td>{{ currency($service->minute) }}</td>
                        @if($service->calculator == 'DISTANCEHOUR') 
                        <td>{{ currency($service->hour) }}</td>
                        @else
                        <td>No Hour Price</td>
                        @endif
                        <td>@lang('servicetypes.'.$service->calculator)</td>
                        <td>
                            @if($service->image) 
                                <img src="{{$service->image}}" style="height: 50px" >
                            @else
                                N/A
                            @endif
                        </td>
                        {{--<td>--}}
                            {{--@if($service->deactive_questions() == 0 && $service->all_questions() != 0)--}}
                                {{--<a class="btn btn-success btn-block" href="{{route('admin.service.question.index', $service->id )}}">{{ $service->all_questions() }}</a>--}}
                            {{--@else--}}
                                {{--<a class="btn btn-danger btn-block label-right" href="{{route('admin.service.question.index', $service->id )}}">{{ $service->all_questions() }}<span class="btn-label">{{ $service->deactive_questions() }}</span></a>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        <td>
                            @if($service->all_questions() != 0)
                                <a class="btn btn-success btn-block" href="{{route('admin.service.question.index', $service->id )}}">{{ $service->all_questions() }}</a>
                            @else
                                <a class="btn btn-danger btn-block" href="{{route('admin.service.question.index', $service->id )}}">{{ $service->all_questions() }}</a>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                @if( Setting::get('demo_mode') == 0)
                                <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-info btn-block">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>@lang('admin.service.Service_Name')</th>
                        <!-- <th>@lang('admin.service.Provider_Name')</th>-->
                        <th>@lang('admin.service.Capacity')</th>
                        <th>@lang('admin.service.Type')</th>
                        <th>@lang('admin.service.Base_Price')</th>
                        <th>@lang('admin.service.Base_Distance')</th>
                        <th>@lang('admin.service.Distance_Price')</th>
                        <th>@lang('admin.service.Time_Price')</th>
                        <th>@lang('admin.service.hourly_Price')</th>
                        <th>@lang('admin.service.Price_Calculation')</th>
                        <th>@lang('admin.service.Service_Image')</th>
                        <th>@lang('admin.service.Questions')</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection