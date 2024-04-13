<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(public $task)
    {
        if ($this->task->has('schedule_time')) {
            $now = Carbon::now();
            $scheduleTime = Carbon::parse($this->task->get('schedule_time'));
            $this->delay($now->diffInSeconds($scheduleTime));
        }

        if ($this->task->has('max_tries')) {
            $this->tries = $this->task->get('max_tries');
        }

        if ($this->task->has('timeout')) {
            $this->timeout = $this->task->get('timeout');
        }
    }

    public function initialMonitorData()
    {
        return $this->task->toArray();
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $client = new Client();
            $response = $client->request($this->task->get('method'), $this->task->get('url'), [
                'headers' => $this->task->get('headers'),
                'query' => $this->task->get('query'),
                'body' => $this->task->get('body')
            ]);

            $this->queueData(['response' => $response->getBody()->getContents()], true);
        } catch (ClientException $e) {
            $this->queueData(['response' => $e->getResponse()->getBody()->getContents()], true);
            throw $e;
        }
    }
}
