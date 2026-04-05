<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details and status of an actor run.
 *
 * Use this tool to check whether a previously started actor run has finished,
 * retrieve its status, and get references to its output dataset and key-value store.
 */
class ApifyGetRun implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_run';
    }

    public function description(): string
    {
        return 'Get details and status of an Apify actor run. Returns the run status (READY, RUNNING, SUCCEEDED, FAILED, ABORTED, TIMING-OUT, TIMED-OUT), output dataset ID, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'runId' => ['type' => 'string', 'required' => true, 'description' => 'The actor run ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $result = $this->service->getRun($args['runId']);

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'actId' => $data['actId'] ?? null,
                'actorTaskId' => $data['actorTaskId'] ?? null,
                'status' => $data['status'] ?? 'UNKNOWN',
                'defaultDatasetId' => $data['defaultDatasetId'] ?? null,
                'defaultKeyValueStoreId' => $data['defaultKeyValueStoreId'] ?? null,
                'defaultRequestQueueId' => $data['defaultRequestQueueId'] ?? null,
                'startedAt' => $data['startedAt'] ?? null,
                'finishedAt' => $data['finishedAt'] ?? null,
                'durationMillis' => $data['durationMillis'] ?? null,
                'stats' => $data['stats'] ?? null,
                'build' => $data['build'] ?? null,
                'buildId' => $data['buildId'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
