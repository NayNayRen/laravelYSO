<div>
    <div class="card-logo-container">
        <img src="{{ $deal->picture_url }}" class="card-logo" alt="{{ $deal->name }}">
    </div>
    <div class="card-discount">{{ $deal->location }}</div>
    <span class="card-name">{{ $deal->name }}</span><br>
</div>
<div>
    <div class="card-rules">
        <span aria-label="Deal expiration date.">Expiration <i class="fa fa-clock-o" aria-hidden="true"></i> :
            @if($deal->expiration === null)
                None
            @elseif($deal->expiration === '')
                None
            @else
                {{ ucwords($deal->expiration) }}
            @endif
        </span><br>
        <span aria-label="Deal limitations.">Limitations <i class="fa fa-exclamation" aria-hidden="true"></i> :
            @if($deal->limitations === null)
                None
            @elseif($deal->limitations === '')
                None
            @else
                {{ ucwords($deal->limitations) }}
            @endif
        </span>
    </div>
    <div class="views-likes-container">
        <div>
            <span>Views: {{ $deal->views }}</span><br>
            <span>Likes:</span><br>
            @php
                $dealLocation = App\Models\CouponLocation::where('cid', $deal->id)->first();
            @endphp
            @if($dealLocation === null)
                <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                        class="fa fa-map-marker" aria-hidden="true"></i></span>
            @elseif($deal->id != $dealLocation->cid)
                <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                        class="fa fa-map-marker" aria-hidden="true"></i></span>
            @else
                @php
                    $locationAddress = App\Models\Location::where('id', $dealLocation->lid)->first();
                @endphp
                @if($locationAddress->lat === null)
                    <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span>
                @elseif($locationAddress->lon === null)
                    <span class="card-location inactive" aria-label="No location for this deal.">Location <i
                            class="fa fa-map-marker" aria-hidden="true"></i></span>
                @else
                    <form action={{ route('locations.show', $dealLocation->lid) }}
                        method="GET">
                        <button type="submit" class="card-location active" title="{{ $locationAddress->location }}"
                            aria-label="View this deal's location." value="map" name="submit">Location <i
                                class=" fa fa-map-marker" aria-hidden="true"></i>
                        </button>
                    </form>
                @endif
            @endif
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
