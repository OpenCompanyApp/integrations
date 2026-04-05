<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LaunchDarklyListFlags implements Tool
{
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_list_flags';
    }

    public function description(): string
    {
        return 'List feature flags in a LaunchDarkly project. Returns flag keys, names, descriptions, and their on/off state per environment.';
    }

    public function parameters(): array
    {
        return [
            'project_key' => ['type' => 'string', 'description' => 'The project key (defaults to the configured project).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of flags to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            $projectKey = $args['project_key'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listFlags($projectKey, $limit, $offset);

            $flags = $result['items'] ?? [];
            $totalCount = $result['_links']['next']['href'] ?? null;

            $summary = array_map(function (array $flag): array {
                $envStates = [];
                foreach ($flag['environments'] ?? [] as $envKey => $env) {
                    $envStates[$envKey] = $env['on'] ?? false;
                }

                return [
                    'key' => $flag['key'] ?? '',
                    'name' => $flag['name'] ?? '',
                    'description' => $flag['description'] ?? '',
                    'kind' => $flag['kind'] ?? '',
                    'temporary' => $flag['temporary'] ?? false,
                    'environments' => $envStates,
                ];
            }, $flags);

            return ToolResult::success([
                'flags' => $summary,
                'count' => count($summary),
                'has_more' => $totalCount !== null,
                'offset' => $offset,
                'limit' => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
