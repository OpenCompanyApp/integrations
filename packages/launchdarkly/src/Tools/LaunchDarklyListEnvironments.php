<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LaunchDarkly project environments.
 */
class LaunchDarklyListEnvironments implements Tool
{
    /**
     * @param  LaunchDarklyService  $service  LaunchDarkly API client.
     */
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_list_environments';
    }

    public function description(): string
    {
        return 'List all environments for a LaunchDarkly project. Returns environment keys, names, and their SDK keys for reference.';
    }

    public function parameters(): array
    {
        return [
            'project_key' => ['type' => 'string', 'description' => 'The project key (defaults to the configured project).'],
        ];
    }

    /**
     * List and normalize environments for a project.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            $projectKey = $args['project_key'] ?? null;
            $result = $this->service->listEnvironments($projectKey);

            $environments = $result['items'] ?? [];

            $summary = array_map(function (array $env): array {
                return [
                    'key' => $env['key'] ?? '',
                    'name' => $env['name'] ?? '',
                    'color' => $env['color'] ?? '',
                    'defaultTtl' => $env['defaultTtl'] ?? null,
                    'secureMode' => $env['secureMode'] ?? false,
                    'requireComments' => $env['requireComments'] ?? false,
                    'confirmChanges' => $env['confirmChanges'] ?? false,
                    'tags' => $env['tags'] ?? [],
                ];
            }, $environments);

            return ToolResult::success([
                'environments' => $summary,
                'count' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
