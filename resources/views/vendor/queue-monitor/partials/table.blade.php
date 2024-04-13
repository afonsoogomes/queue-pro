<table class="w-full rounded-md whitespace-no-wrap rounded-md border dark:border-gray-600 border-separate border-spacing-0">

    <thead class="rounded-t-md">

        <tr>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Status')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Job')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Attempt')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Url')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Method')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Headers')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Query')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Body')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Response')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600">@lang('Started')</th>
            <th class="px-4 py-3 font-medium text-left text-xs text-gray-600 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-600"></th>
        </tr>

    </thead>

    <tbody class="bg-gray-50 dark:bg-gray-700">

        @forelse($jobs as $job)

            <tr class="font-sm leading-relaxed">

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 border-b border-gray-200 dark:border-gray-600">
                    @include('queue-monitor::partials.job-status', ['status' => $job->status])
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">

                    @if (isset($job->getData()['title']))
                        {{ $job->getData()['title'] }}
                    @else
                        {{ $job->getBaseName() }}
                    @endif

                    <span class="ml-1 text-xs text-gray-600 dark:text-gray-400">
                        #{{ $job->job_id }}
                    </span>

                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ $job->attempt }}
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ $job->getData()['url'] ?? '' }}
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ $job->getData()['method'] ?? '' }}
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ json_encode($job->getData()['headers'] ?? []) }}
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ json_encode($job->getData()['query'] ?? []) }}
                </td>

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 font-medium border-b border-gray-200 dark:border-gray-600">
                    {{ json_encode($job->getData()['body'] ?? []) }}
                </td>

                @if(config('queue-monitor.ui.show_custom_data'))

                    <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 border-b border-gray-200 dark:border-gray-600">
                        <textarea rows="4" class="w-64 text-xs p-1 border rounded text-gray-800" readonly>{{  json_encode(json_decode($job->getData()['response'] ?? '{}'), JSON_PRETTY_PRINT) }}</textarea>
                    </td>

                @endif

                <td class="p-4 text-gray-800 dark:text-gray-300 text-sm leading-5 border-b border-gray-200 dark:border-gray-600">
                    @if ($job->status === \romanzipp\QueueMonitor\Enums\MonitorStatus::QUEUED && isset($job->getData()['schedule_time']))
                        {{ \Carbon\Carbon::parse($job->getData()['schedule_time'])->diffForHumans(now()) }}
                    @else
                        {{ $job->started_at?->diffForHumans() }}
                    @endif
                </td>

                @if(config('queue-monitor.ui.allow_deletion') || config('queue-monitor.ui.allow_retry'))

                    <td class="p-4 eading-5 border-b border-gray-200 dark:border-gray-600">
                        @if(config('queue-monitor.ui.allow_retry') && $job->canBeRetried())
                            <form action="{{ route('queue-monitor::retry', [$job]) }}" method="post">
                                @csrf
                                @method('patch')
                                <button class="px-3 py-2 bg-blue-200 dark:hover:bg-blue-200  text-xs font-medium rounded transition-colors duration-150">
                                    @lang('Retry')
                                </button>
                            </form>
                        @endif
                        @if(config('queue-monitor.ui.allow_deletion'))
                            <form action="{{ route('queue-monitor::destroy', [$job]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="px-3 py-2 bg-transparent hover:bg-red-100 dark:hover:bg-red-800 text-red-800 dark:text-red-500 dark:hover:text-red-200 text-xs font-medium rounded transition-colors duration-150">
                                    @lang('Delete')
                                </button>
                            </form>
                        @endif
                    </td>

                @endif

            </tr>

        @empty

            <tr>
                <td colspan="100" class="">
                    <div class="my-6">
                        <div class="text-center">
                            <div class="text-gray-500 text-lg">
                                @lang('No Jobs')
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        @endforelse

    </tbody>

    <tfoot class="bg-white dark:bg-transparent">

        <tr>
            <td colspan="100" class="px-2 py-4">
                <div class="flex justify-between">
                    <div class="pl-2 text-sm text-gray-600 dark:text-gray-400">
                        @lang('Showing')
                        @if($jobs->total() > 0)
                            <span class="font-medium">{{ $jobs->firstItem() }}</span> @lang('to')
                            <span class="font-medium">{{ $jobs->lastItem() }}</span> @lang('of')
                        @endif
                        <span class="font-medium">{{ $jobs->total() }}</span> @choice('result|results', $jobs->total())
                    </div>

                    <div>
                        <a class="py-2 px-4 mx-1 text-xs font-medium @if(!$jobs->onFirstPage()) bg-gray-200 hover:bg-gray-300 cursor-pointer @else text-gray-600 bg-gray-100 cursor-not-allowed @endif rounded"
                           @if(!$jobs->onFirstPage()) href="{{ $jobs->previousPageUrl() }}" @endif>
                            @lang('Previous')
                        </a>
                        <a class="py-2 px-4 mx-1 text-xs font-medium @if($jobs->hasMorePages()) bg-gray-200 hover:bg-gray-300 cursor-pointer @else text-gray-600 bg-gray-100 cursor-not-allowed @endif rounded"
                           @if($jobs->hasMorePages()) href="{{ $jobs->url($jobs->currentPage() + 1) }}" @endif>
                            @lang('Next')
                        </a>
                    </div>
                </div>
            </td>
        </tr>

    </tfoot>

</table>
