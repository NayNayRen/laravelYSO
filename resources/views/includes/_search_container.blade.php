{{-- SEARCH CONTAINER --}}
<div class="search-container">
    <form action={{ route('deals.search') }} class="search-form" name="searchForm" method="GET">
        <input type="text" name="search" id="search-field" class="search-field"
            placeholder="Search by type, city, or zip...">
        <span class="search-form-error">{{ $message }}</span>
        <button type="submit" id="search-button" class="search-button"><i class="fa fa-search"
                aria-hidden="true"></i></button>
        <button type="button" id="map-button" class="search-button"><i class="fa fa-map-marker"
                aria-hidden="true"></i></button>
    </form>
</div>
