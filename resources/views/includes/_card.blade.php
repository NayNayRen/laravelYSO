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
                <i class="fa fa-share" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>
        <a href="/deals/{{ $deal->id }}">
            <div class="get-deal-button">Get Deal Now!</div>
        </a>
    </div>
</div>
