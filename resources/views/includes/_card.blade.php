<div class="card">
    <div>
        <div class="card-logo-container">
            <img src="{{ $deal->picture_url }}" class="card-logo" alt="{{ $deal->name }}">
        </div>
        <span class="card-discount">{{ $deal->location }}</span><br>
        <span class="card-name">{{ $deal->name }}</span><br>
    </div>
    <div>
        <div class="views-likes-container">
            <div>
                <span>Views: {{ $deal->views }}</span><br>
                <span>Likes:</span>
            </div>
            <div class="views-likes-icons">
                <span aria-label="Share this item.">
                    <i class="fa fa-share" aria-hidden="false"></i>
                </span>
                <span aria-label="Favorite this item.">
                    <i class="fa fa-star" aria-hidden="false"></i>
                </span>
            </div>
        </div>
        <a href="/deals/{{ $deal->id }}">
            <div class="get-deal-button">Get Deal Now!</div>
        </a>
    </div>
</div>
