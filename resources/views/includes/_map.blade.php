{{-- HIDDEN MAP --}}
<div class="hidden-map">
    <!-- SHOW SEARCHED LOCATION RESULTS -->
    <div class="hidden-map-location-button-container">
        <span class="hidden-map-location-button">Show<span
                class="hidden-map-location-count">{{ count($locations) }}</span>
        </span>
    </div>
    <span class='hidden-map-header'>Click 'Show' to pin search results, 'Clear' to remove.</span>
    <!-- CLOSE HIDDEN MAP -->
    <div class="hidden-map-close-button-container">
        <span class="hidden-map-close-button">Close</span>
    </div>
    {{-- CLEARS MARKERS FROM MAP --}}
    <span class="clear-map-button">Clear</span>
    @include('includes._map_message')
    <div id="map">
    </div>
</div>
