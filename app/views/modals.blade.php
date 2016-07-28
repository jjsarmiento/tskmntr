@yield('modal-content')

{{--MODAL FOR TERMS -- START--}}
<div class="modal modal-vcenter fade lato-text" id="TERMSMODAL" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                <h3>Terms of Service - Proveek BETA</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#ES_VERSION" aria-controls="home" role="tab" data-toggle="tab">English Version</a></li>
                        <li role="presentation"><a href="#TG_VERSION" aria-controls="profile" role="tab" data-toggle="tab">Tagalog Version</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fade in" id="ES_VERSION">
                        <div class="col-md-12">
                            <br/>
                            {{SystemSetting::where('type', 'SYSSETTINGS_TOS_ES')->pluck('value')}}
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active fade" id="TG_VERSION">
                        <div class="col-md-12">
                            <br/>
                            {{SystemSetting::where('type', 'SYSSETTINGS_TOS_TG')->pluck('value')}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--MODAL FOR TERMS -- END--}}

{{--MODAL FOR PRIVACY AND POLICY -- START--}}

<div class="modal modal-vcenter fade lato-text" id="PRIPOLMODAL" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>
                <h3>Privacy Policy - Proveek BETA</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#POL_ES_VERSION" aria-controls="home" role="tab" data-toggle="tab">English Version</a></li>
                        <li role="presentation"><a href="#POL_TG_VERSION" aria-controls="profile" role="tab" data-toggle="tab">Tagalog Version</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active fade in" id="POL_ES_VERSION">
                        <div class="col-md-12">
                            <br/>
                            {{SystemSetting::where('type', 'SYSSETTINGS_POLICY_ES')->pluck('value')}}
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane active fade" id="POL_TG_VERSION">
                        <div class="col-md-12">
                            <br/>
                            {{SystemSetting::where('type', 'SYSSETTINGS_POLICY_TG')->pluck('value')}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--MODAL FOR PRIVACY AND POLICY -- END--}}

