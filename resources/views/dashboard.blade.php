@section('main-class', 'flex flex-1')

<x-app-layout>
    <iframe src="{{ config('app.url') . '/' . config('queue-monitor.ui.route.prefix') }}" style="width: 100%; height: auto; border: 0;" />
</x-app-layout>
