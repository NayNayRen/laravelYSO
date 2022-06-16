@include('includes._header')
<div class="main">
    <div class="container">
        <div class="container-left">
            <span class="category-heading">Most Popular</span>
        </div>
        {{-- MAIN CONTENT CONTAINER --}}
        <div class="container-right">
            {{-- CUSTOM PAGE ARROWS --}}
            {{ $deals->links('vendor.pagination.custom-pagination') }}
            <div class="card-display-view-all">
                @foreach($deals as $deal)
                    {{-- CARD BLOCK --}}
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
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('includes._footer')
