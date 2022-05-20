<div class="iq-search-bar">
    <form action="#" class="searchbox">
        <input type="text" class="text search-input" wire:model="keySearch" wire.keydown.enter="updateKeySearch"
               placeholder="Escriba aquí para buscar..." style="border-radius: 20px !important;">
        <a class="search-link" href="javascript:;" wire:click.prevent="updateKeySearch" style="top: 3px;">
            <i class="simple-icon-magnifier"></i>
        </a>
    </form>
</div>
