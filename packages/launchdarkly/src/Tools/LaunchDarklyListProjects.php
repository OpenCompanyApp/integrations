<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

use OpenCompany\Integrations\LaunchDarkly\LaunchDarklyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LaunchDarkly projects.
 */
class LaunchDarklyListProjects implements Tool
{
    /**
     * @param  LaunchDarklyService  $service  LaunchDarkly API client.
     */
    public function __construct(
        private LaunchDarklyService $service,
    ) {}

    public function name(): string
    {
        return 'launchdarkly_list_projects';
    }

    public function description(): string
    {
        return 'List all LaunchDarkly projects. Returns project keys, names, and the number of environments in each project.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List and normalize LaunchDarkly projects.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LaunchDarkly integration is not configured.');
            }

            $result = $this->service->listProjects();

            $projects = $result['items'] ?? [];

            $summary = array_map(function (array $project): array {
                $environments = $project['environments'] ?? [];

                return [
                    'key' => $project['key'] ?? '',
                    'name' => $project['name'] ?? '',
                    'description' => $project['description'] ?? '',
                    'tags' => $project['tags'] ?? [],
                    'environment_count' => count($environments),
                    'environment_keys' => array_keys($environments),
                ];
            }, $projects);

            return ToolResult::success([
                'projects' => $summary,
                'count' => count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
