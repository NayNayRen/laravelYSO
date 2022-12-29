{{-- HIDDEN MAP --}}
<div class="hidden-map">
    <!-- SHOW SEARCHED LOCATION RESULTS -->
    <div class="hidden-map-location-button-container">
        <span class="hidden-map-location-button">Show<span
                class="hidden-map-location-count">{{ count($locations) }}</span>
        </span>
    </div>
    <span class='hidden-map-header'>Click 'Show' to drop pins, 'Clear' to remove them.</span>
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
            <span type='button' class="map-distance-go-button">Go
            </span>
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
            </ul>
        </div>
    </div>
    @if ($locations->count() < 1)
        <div class="map-location-list-container">
            <div>
                <ul class="map-location-list">
                    <li class="map-location-list-item">
                        <span class="map-location-name">No Location...
                        </span>
                        <span class="map-location-address">No Address...</span>
                    </li>
                </ul>
            </div>
            <div>
                <span class="map-location-list-button" aria-label="Show locations list."><i class="fa fa-list-ul"
                        aria-hidden="true"></i>
                </span>
            </div>
        </div>
    @else
        <div class="map-location-list-container">
            <div>
                <ul class="map-location-list">
                    @foreach ($locations as $location)
                        <li class="map-location-list-item">
                            <span class="map-location-name">{{ $location->name }}
                                <span class="map-location-distance"></span>
                                {{-- USED TO GET FAVORITES LOCATION --}}
                                @if ($favorites != null)
                                    @foreach ($favorites as $favorite)
                                        @php
                                            $favoriteLocations = App\Models\CouponLocation::where('cid', $favorite->id)->get();
                                        @endphp
                                        @foreach ($favoriteLocations as $favoriteLocation)
                                            @if ($location->id === $favoriteLocation->lid)
                                                <span id="map-location-favorite-icon"
                                                    class="map-location-favorite-icon"><i class="fa fa-star"
                                                        aria-hidden="true"></i></span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                {{--  --}}
                            </span>
                            <span class="map-location-address">{{ $location->location }}<i class="fa fa-map-marker"
                                    aria-hidden="true"></i></span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <span class="map-location-list-button" aria-label="Show locations list."><i class="fa fa-list-ul"
                        aria-hidden="true"></i>
                </span>
            </div>
        </div>
    @endif
    <div id="map">
    </div>
</div>
