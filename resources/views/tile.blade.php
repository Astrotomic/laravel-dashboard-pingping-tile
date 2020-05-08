<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div class="flex justify-center items-center h-10">
            <div class="text-3xl leading-none w-10">📶</div>
            <div class="text-xl leading-none">PingPing</div>
        </div>
        <ul class="self-center | divide-y-2">
            @foreach($monitors as $monitor)
                <li class="py-1">
                    <div class="grid grid-cols-1-auto">
                        <span class="truncate" title="{{ $monitor->name() }}">
                            {{ $monitor->name() }}
                        </span>
                        <span class="
                            font-bold
                            text-uppercase
                            {{ $monitor->isUp() ? 'text-success' : 'text-error' }}
                        ">
                            {{ $monitor->isUp() ? 'up' : 'down' }}
                        </span>
                        <span class="
                            font-bold
                            text-uppercase
                            {{ $monitor->isSecure() ? 'text-success' : 'text-error' }}
                        ">
                            {{ $monitor->isSecure() ? 'valid' : 'invalid' }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1-auto">
                        <span class="text-sm leading-none text-dimmed">
                            ✅ {{ $monitor->avgUptime() }}%
                        </span>
                        <span class="text-sm leading-none text-dimmed">
                            ⌛ {{ $monitor->avgResponseTime() }}ms
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-dashboard-tile>
