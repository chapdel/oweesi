<div>
    {{-- Success is as dangerous as failure. --}}
    @if ($type == 'btn')
            <button class="btn btn-primary btn-sm">ddkjdk</button>
    @else
            <a href='{{$route}}' class="btn btn-primary btn-sm">{{ $label }}</a>
    @endif
</div>
