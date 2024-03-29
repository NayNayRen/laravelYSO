{{-- HIDDEN FAVORITE ADDED MESSAGE --}}
<div class="favorite-added-message">
    <h2>Saved To Your Favorites</h2>
    <p id="favorite-added-name"></p>
    <div>
        <span>
            <i class="fa fa-check" aria-hidden="true"></i>
        </span>
        <span>
            This deal has been saved for future use in your Favorites.
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
    <button type="button" class="message-button favorite-added-button">OK</button>
    <a href={{ route('deals.index') }}>Show Me More Deals</a>
</div>
