@extends('layouts.master')

@section('title', 'RESTO POS - Rename Reports')

@section('custom_headerscripts')    


@endsection


@section('globalsearch')
    
    @include('layouts.globalsearch', ['placeholder'=> 'search report'])

@endsection

@section('breadcrumb-title')

    <div class="page-title-right">
                
        <ol class="breadcrumb m-0">

            {{--<li class="breadcrumb-item"><a href="/">Home</a></li>--}}

            {{--<li class="breadcrumb-item active"> Home</li>--}}

        </ol><!--END breadcrumb m-0-->

    </div><!--END page-title-right-->

    <h4 class="page-title text-muted"> <a href="/rename-reports" title="">  Rename Reports </a>  </h4>


@endsection




@section('content')
    
   
    <div class="row">

        <div class="col-12">

            <div class="card-box">

                <div class="responsive-table-plugin">

                    <div class="table-rep-plugin">

                        <div class="table-responsive" data-pattern="priority-columns">

                            <table id="tech-companies-1" class="table table-sm table-striped mb-0">
                                
                                <thead>

                                    <tr>
                                        <th>Code</th>
                                        <th>Default Description</th>
                                        <th>New Description</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    <form method="POST">

                                        {{ csrf_field()  }}

                                        @foreach($reports as $s)

                                            <tr>
                                                
                                                
                                                <td>{{$s->pk_permalink}}</td>

                                                <td>{{$s->description}}</td>
                                                
                                                <td>
                                                    <input type="text" class="form-control" name="name[{{$s->pk_permalink}}]" value="{{$s->newdescription ?? $s->description}}" required="">
                                                </td>


                                            </tr>
                                        @endforeach
                                        
                                        
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="3">
                                                <button type="submit" class="pull-right btn btn-bordred-primary waves-effect  width-md">
                                                    Save
                                                </button>
                                            </td>
                                        </tr>

                                    </form>

                                    
                                
                                </tbody>

                            </table><!--END table table-sm table-striped mb-0-->

                        </div><!--END table-responsive-->

                    </div><!--END table-rep-plugin-->

                </div><!--END responsive-table-plugin-->


            </div><!--END card-box-->

        </div><!--END col-12-->


 

    </div>
    <!-- end row -->



@endsection



@section('custom_footerscripts')

    @include('layouts.alert', ['alerttype'=> 'pnotify'])

@endsection

