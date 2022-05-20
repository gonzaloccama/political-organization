<div class="tab-pane fade {{ $tab_pane == 'photos'?'active show':'' }}" id="{{$tab_pane}}" role="tabpanel">
    <div class="iq-card">
        <div class="iq-card-body">
            @include('livewire.user.profile-component.photos')
        </div>
    </div>
</div>
