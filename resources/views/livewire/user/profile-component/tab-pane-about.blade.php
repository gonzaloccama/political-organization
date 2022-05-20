<div class="tab-pane fade {{ $tab_pane == 'about'?'active show':'' }}" id="{{$tab_pane}}" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-body">
            <div class="row">
                @include('livewire.user.profile-component.personal-information')
            </div>
        </div>
    </div>
</div>
