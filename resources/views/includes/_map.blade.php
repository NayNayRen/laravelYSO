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
    <div class="map-search-distance-container">
        <div>
            <span type='button' class="map-search-distance-button">
                Distance</span>
            <input type='button' class="map-distance-go-button" value="Go">
            </input>
            <span class="map-search-distance-arrow">
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </span>
            <ul class="map-search-distance-dropdown">
                <li class="map-search-distance-selection">
                    25</li>
                <li class="map-search-distance-selection">
                    50</li>
                <li class="map-search-distance-selection">
                    75</li>
                <li class="map-search-distance-selection">
                    100</li>
                <li class="map-search-distance-selection">
                    No Limit</li>
                <li class="map-search-distance-selection">
                    Reset</li>
            </ul>
        </div>
    </div>
    <div id="map">
    </div>
</div>
