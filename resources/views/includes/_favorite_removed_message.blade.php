{{-- HIDDEN FAVORITE REMOVED MESSAGE --}}
<div class="favorite-removed-message">
    <h2>Removed From Your Favorites</h2>
    <p id="favorite-removed-name"></p>
    <div>
        <span>
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>
        <span>
            This deal has been removed from future use in your Favorites.
        </span>
    </div>
    <div>
        <span>
            <img src="{{ asset('img/male-profile.png') }}" alt="Profile Picture">
        </span>
        <span>
            You can manage your saved deals in your Dashboard.
        </span>
    </div>
    <button type="button" class="message-button favorite-removed-button">OK</button>
    <a href={{ route('deals.index') }}>Show me more deals</a>
</div>
