@extends('layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Text Brigade</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li class="active">
                <strong>Text Brigade</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <!-- Level Table -->
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Text Brigade Form</h5>
                    <div class="ibox-tools pull-right">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- /.ibox-titel -->

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6 b-r">
                            @if(count($errors->all()))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($response))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success">
                                            <ul>
                                               * {{ $response }}
                                               <br>
                                               * <a href="{{ route('textbrigade.index') }}">
                                                    Click here to send new message!
                                                <a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <form role="form" method="post" action="{{ route('textbrigade.create') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Message :</label>
                                        <textarea class="form-control" style="height: 90px" name="message" value=" ">
                                        </textarea>
                                    </div>
                                    <div>
                                        <input class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                               type="submit"
                                               value="Send Message"
                                        >
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <h4>Select message destination!</h4>
                            <p>With this feature user can select all/employee/student/student per year and section.</p>
                            <p>Soon!</p>
                        </div>
                    </div>
                </div>
                <!-- /.ibox-content -->
            </div>
        </div>
        <!-- End Level Table -->
    </div>
</div>

@endsection

@section('js_script')

<script type="text/javascript">
/** Highlight Sidebard **/
$('#textbrigade_settings').addClass('active');
$('title').text('SIS | Text Brigade');
</script>

<script>

    $(document).ready(function(){
        $('textarea').val('')
    });
</script>


@endsection
