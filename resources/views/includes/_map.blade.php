{{-- HIDDEN DUMMY MAP --}}
<div class="hidden-map">
    <!-- SHOW LOCATION -->
    <div class="hidden-map-location-button-container">
        <span class="hidden-map-location-button">Show<span
                class="hidden-map-location-count">{{ count($searchedLocations) }}</span></span>

    </div>
    <span class='hidden-map-header'>Click the 'Show' button to pin search results.</span>
    <!-- CLOSE HIDDEN MAP -->
    <div class="hidden-map-close-button-container">
        <span class="hidden-map-close-button">Close</span>
    </div>
    @include('includes._map_message')
    <div id="map">
    </div>
</div>
