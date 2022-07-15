{{-- SEARCH CONTAINER --}}
<div class="search-container">
    <form action={{ route('deals.search') }} class="search-form" name="searchForm" method="GET">
        <input type="text" name="search" id="search-field" class="search-field"
            placeholder="Search by type, city, or zip...">
        <span class="search-form-error">{{ $message }}</span>
        <button type="submit" id="search-button" class="search-button" aria-label="Search" title="Search for a deal."><i
                class="fa fa-search" aria-hidden="false"></i></button>
        <button type="button" id="map-open-button" class="search-button" aria-label="Open map."
            title="Open your map."><i class="fa fa-map-marker" aria-hidden="false"></i></button>
    </form>
</div>
