@if (isset($affilateblock))
<div class="affilate__block container">
    <div class="top__title affilate__top">
            <img src="{{ asset('storage/images/affilate-top.svg') }}" alt="affilate top">
            <h3>{{ __('Affiliate program') }}</h3>
    </div>
    <div class="affilate__content"> 
    {!! $affilateblock !!}


        <div class="partent__earned">
                    <a href="/partnery/" class="btn-orange">{{ __('find out more') }}</a>
                    <div class="partent__title"> {{ __('Our partners have already earned') }}</div>

                    <div class="partent__count" id="affilate__counter">
                        <affilate-component
                        :allstats = @json($allstats)
                        :course_usd = @json($course_usd)
                        ></affilate-component>
                    </div>
        </div>

    </div>
</div>

 
@endif