{{-- MAIN INDEX PAGES CARDS --}}
{{-- ONLY USED THERE --}}
<div>
    <div class="card-logo-container">
        <img src="{{ $deal->picture_url }}" class="card-logo" alt="{{ $deal->name }}">
    </div>
    <div class="card-discount">{{ $deal->location }}</div>
    <div class="card-name">{{ $deal->name }}</div>
</div>
<div>
    <div class="views-likes-container">
        <div>
            <span>Views: {{ $deal->views }}</span><br>
            <span>Likes:</span>
        </div>
        <div class="views-likes-icons">
            {{-- SHOW USERS SOCIAL LINKS --}}
            @if (auth()->user())
                <span class='share-deal user' aria-label="Share this item." name="{{ $deal->name }}">
                    <i class="fa fa-share" aria-hidden="false"></i>
                </span>
            @else
                {{-- SHOW GUEST MESSAGE --}}
                <span class='share-deal guest' aria-label="Share this item.">
                    <i class="fa fa-share" aria-hidden="false"></i>
                </span>
            @endif
            @php
                if (auth()->user()) {
                    $check = App\Models\Favorite::where('deal_id', $deal->id)
                        ->where('user_id', auth()->user()->id)
                        ->first();
                } else {
                    $check = null;
                }
            @endphp
            {{-- IF LOGGED IN, HIGHLIGHT IF A FAVORITE --}}
            @if ($check != null)
                <span class='favorite-button' aria-label="Favorite this item.">
                    <i class="fa fa-star add-favorite favorite" id="{{ $deal->id }}" name="{{ $deal->name }}"
                        aria-hidden="false"></i>
                </span>
            @else
                {{-- IF NOT A FAVORITE DONT HIGHLIGHT --}}
                <span class='favorite-button' aria-label="Favorite this item.">
                    <i class="fa fa-star add-favorite" id="{{ $deal->id }}" name="{{ $deal->name }}"
                        aria-hidden="false"></i>
                </span>
            @endif
        </div>
    </div>
    <a href="{{ route('deals.show', $deal->id) }}">
        <div class="get-deal-button">Get Deal Now!</div>
    </a>
</div>
