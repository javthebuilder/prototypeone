@php
    $back_url = (isset($back_url)) ? $back_url : '/home';
    //Note: manual jquery action @the angular controller
    //Note: angular default will cause some delay @html rendering
    // - hide url by using $('#ajaxBackUrl').prop('hidden', true)
    // - invoke save button by using $('#btnAjaxSubmit').click()
    // - disable save button by using $('#btnAjaxSubmit').prop('disabled', true)
    // - dynamic save message is set by $('#msgAjaxSubmit').html('message')
@endphp


<div class="widget-chart-1">
    
    <div class="widget-chart-box-1 float-left" dir="ltr">
        
        {{--btn btn-default btn-round --}}
        <a id="ajaxBackUrl" href="{{$back_url}}" class="pull-left btn btn-lighten-secondary waves-effect  width-md" rel="tooltip" title="Go Back"  >
            Go Back
        </a>

    </div>

    <div class="widget-detail-1 text-right">


        <button id="btnAjaxSubmit" class="pull-right btn btn-bordred-primary waves-effect  width-md">
            <span id="msgAjaxSubmit">
                Save
            </span>
        </button>


    </div>
</div>

