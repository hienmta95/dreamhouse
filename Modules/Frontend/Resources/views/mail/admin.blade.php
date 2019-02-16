@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Liên hệ DreamGo
        @endcomponent
    @endslot
    {{-- Body --}}
    Khách hàng có tên {{ $data['hoten'] }} vừa mới thực hiện một liên hệ từ phía website {{ route('homepage') }}
    <br />
    Thông tin của khách hàng:<br />
    Họ tên : {{ $data['hoten'] }}<br />
    SĐT: {{ $data['dienthoai'] }}<br />
    Di động: {{ $data['didong'] }}<br />
    Email: {{ $data['email'] }}<br />
    Công ty: {{ $data['congty'] }}<br />
    Địa chỉ: {{ $data['diachi'] }}<br />
    Nội dung: {{ $data['noidung'] }}<br />
    Chủ đề: {{ $data['chude'] }}<br />

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
