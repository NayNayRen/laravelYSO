<div class="card">
    <div>
        <div class="card-logo-container">
            <img src="{{ $deal->picture_url }}" class="card-logo" alt="{{ $deal->name }}">
        </div>
        <span class="card-discount">{{ $deal->location }}</span><br>
        <span id="card-name">{{ $deal->name }}</span><br>
    </div>
    <div>
        <div class="views-likes-container">
            <div>
                <span>Views: {{ $deal->views }}</span><br>
                <span>Likes:</span>
            </div>
            <div class="views-likes-icons">

                <span class='share-button' aria-label="Share this item.">
                    <i class="fa fa-share" aria-hidden="false"></i>
                </span>
                @php
                    if(auth()->user())
                    {
                    $check =
                    App\Models\Favourite::where('deal_id',$deal->id)->where('user_id',auth()->user()->id)->first();
                    }
                    else
                    {
                    $check = null;
                    }
                @endphp
                @if($check !=null)
                    <span class='favorite-button' aria-label="Favorite this item.">
                        <i class="fa fa-star add-favourite favourite" id="{{ $deal->id }}"></i>
                    </span>
                @else
                    <span class='favorite-button' aria-label="Favorite this item.">
                        <i class="fa fa-star add-favourite" id="{{ $deal->id }}"></i>
                    </span>
                @endif

                {{-- <i class="fa fa-star" aria-hidden="true"></i> --}}
            </div>
        </div>
        <a href="{{ route('deals.show',$deal->id) }}">
            <div class="get-deal-button">Get Deal Now!</div>
        </a>
    </div>
</div>