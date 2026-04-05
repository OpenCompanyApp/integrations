<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Run an Apify actor with the given input configuration.
 *
 * This tool starts a new actor run on Apify. Actors are serverless programs
 * that can scrape web pages, process data, or automate workflows. After
 * starting a run, use `apify_get_run` to check its status and retrieve results.
 */
class ApifyRunActor implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_run_actor';
    }

    public function description(): string
    {
        return 'Run an Apify actor. Provide the actor ID and input configuration to start a new run. Returns the run details including run ID and status. Use apify_get_run to check progress.';
    }

    public function parameters(): array
    {
        return [
            'actorId' => ['type' => 'string', 'required' => true, 'description' => 'The actor ID (e.g., "apify/web-scraper", "apify/cheerio-scraper") or numeric ID.'],
            'input' => ['type' => 'object', 'required' => true, 'description' => 'The input configuration for the actor run. Structure depends on the specific actor.'],
            'build' => ['type' => 'string', 'description' => 'Actor build to use (e.g., "latest", "beta"). Defaults to the latest build.'],
            'waitForFinish' => ['type' => 'integer', 'description' => 'Maximum seconds to wait for the run to finish (0–300). Defaults to 0 (return immediately).'],
            'timeout' => ['type' => 'integer', 'description' => 'Timeout for the actor run in seconds. Overrides the actor\'s default timeout.'],
            'memory' => ['type' => 'integer', 'description' => 'Memory allocation in megabytes (128, 256, 512, 1024, 2048, 4096, 8192). Overrides the actor\'s default.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $actorId = $args['actorId'];
            $input = $args['input'] ?? [];

            $options = [];
            if (isset($args['build'])) {
                $options['build'] = $args['build'];
            }
            if (isset($args['waitForFinish'])) {
                $options['waitForFinish'] = (int) $args['waitForFinish'];
            }
            if (isset($args['timeout'])) {
                $options['timeout'] = (int) $args['timeout'];
            }
            if (isset($args['memory'])) {
                $options['memory'] = (int) $args['memory'];
            }

            $result = $this->service->runActor($actorId, $input, $options);

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'actId' => $data['actId'] ?? null,
                'status' => $data['status'] ?? 'UNKNOWN',
                'defaultDatasetId' => $data['defaultDatasetId'] ?? null,
                'defaultKeyValueStoreId' => $data['defaultKeyValueStoreId'] ?? null,
                'startedAt' => $data['startedAt'] ?? null,
                'buildId' => $data['buildId'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
