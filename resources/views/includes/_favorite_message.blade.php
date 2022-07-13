{{-- HIDDEN FAVORITE MESSAGE FOR THE SINGLED DEAL PAGE --}}
<div class="selected-deal-favorite-message">
    <h2>Saved to your Favorites</h2>
    <p>{{ $deal->name }}</p>
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
    <button type="button" id="remove-favorite-message" class="selected-deal-message-button">OK</button>
    <a href={{ route('deals.index') }}>Show me more deals</a>
</div>
