@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Nội thất DreamGo
        @endcomponent
    @endslot
    {{-- Body --}}
    Cám ơn bạn {{ $data['hoten'] }} đã liên hệ, chúng tôi sẽ có phản hồi hoặc liên hệ lại với bạn trong thời gian gần nhất. <br />
    {{ route('frontend.homepage') }}

    {{-- Subcopy --}}
    {{--@isset($subcopy)--}}
        {{--@slot('subcopy')--}}
            {{--@component('mail::subcopy')--}}
                {{--{{ $subcopy }}--}}
            {{--@endcomponent--}}
        {{--@endslot--}}
    {{--@endisset--}}
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} DreamGo. superAdmin!
        @endcomponent
    @endslot
@endcomponent
