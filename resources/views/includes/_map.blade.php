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
                15 miles</span>
            <input type='button' class="map-distance-go-button" value="Go">
            </input>
            <span class="map-search-distance-arrow">
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </span>
            <ul class="map-search-distance-dropdown">
                <li class="map-search-distance-selection" value="25">
                    25 miles</li>
                <li class="map-search-distance-selection" value="50">
                    50 miles</li>
                <li class="map-search-distance-selection" value="75">
                    75 miles</li>
                <li class="map-search-distance-selection" value="100">
                    100 miles</li>
                <li class="map-search-distance-selection">
                    No Limit</li>
                <li class="map-search-distance-selection">
                    My Locale</li>
                <li class="map-search-distance-selection focus-single-pin">
                    Go To Pin</li>
            </ul>
        </div>
    </div>
    <div class="map-location-list-container">
        <ul class="map-location-list">
            @foreach($locations as $location)
                <li class="map-location-name">{{ $location->name }}</li>
            @endforeach
        </ul>
    </div>
    <div id="map">
    </div>
</div>
