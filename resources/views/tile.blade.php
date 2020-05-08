<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div class="flex justify-center items-center h-10">
            <div class="text-3xl leading-none w-10">📶</div>
            <div class="text-xl leading-none">PingPing</div>
        </div>
        <ul class="self-center | divide-y-2">
            @foreach($monitors as $monitor)
                <li class="flex py-1">
                    <span class="flex-grow truncate" title="{{ $monitor->name() }}">
                        {{ $monitor->name() }}
                    </span>
                    <span class="grid grid-cols-2 gap-1">
                        <span class="
                            px-2 py-1 uppercase text-center leading-none text-xs rounded border-2
                            {{ $monitor->uptimeDisplayClass() }}
                        ">
                            {{ $monitor->uptimeState() }}
                        </span>
                        <span class="
                            px-2 py-1 uppercase text-center leading-none text-xs rounded border-2
                            {{ $monitor->sslDisplayClass() }}
                        ">
                            {{ $monitor->sslState() }}
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</x-dashboard-tile>
