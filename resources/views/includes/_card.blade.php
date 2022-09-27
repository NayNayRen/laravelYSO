{{-- <div class="card"> --}}
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
            @if(auth()->user())
                <span class='share-deal user' aria-label="Share this item." name="{{ $deal->name }}">
                    <i class="fa fa-share" aria-hidden=" false"></i>
                </span>
            @else
                <span class='share-deal guest' aria-label="Share this item.">
                    <i class="fa fa-share" aria-hidden=" false"></i>
                </span>
            @endif
            @php
                if(auth()->user()){
                $check =
                App\Models\Favorite::where('deal_id',$deal->id)->where('user_id',auth()->user()->id)->first();
                }else{
                $check = null;
                }
            @endphp
            @if($check != null)
                <span class='favorite-button' aria-label="Favorite this item.">
                    <i class="fa fa-star add-favorite favorite" id="{{ $deal->id }}" name="{{ $deal->name }}"
                        aria-hidden="false"></i>
                </span>
            @else
                <span class='favorite-button' aria-label="Favorite this item.">
                    <i class="fa fa-star add-favorite" id="{{ $deal->id }}" name="{{ $deal->name }}"
                        aria-hidden="false"></i>
                </span>
            @endif
        </div>
    </div>
    <a href="{{ route('deals.show',$deal->id) }}">
        <div class="get-deal-button">Get Deal Now!</div>
    </a>
</div>
{{-- </div> --}}
