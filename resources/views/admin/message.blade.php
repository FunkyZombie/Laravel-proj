@if (session()->has('success'))
    <x-alert type="success"  :message="session()->get('success')" ></x-alert>
@elseif(session()->has('error'))
    <x-alert type="warning"  :message="session()->get('error')" ></x-alert>
@endif