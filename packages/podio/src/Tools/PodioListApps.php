<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all apps in a Podio workspace.
 *
 * Returns an array of app objects with IDs, names, and configuration details.
 * Use this to discover which apps (data structures) are available in a workspace.
 */
class PodioListApps implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_list_apps';
    }

    public function description(): string
    {
        return 'List all apps in a Podio workspace. Returns app IDs, names, item counts, and configuration. Use this to discover available apps before querying their items.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio space (workspace) ID to list apps for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $spaceId = (int) $args['space_id'];
            $apps = $this->service->listApps($spaceId);

            $formatted = array_map(function (array $app): array {
                return [
                    'app_id' => $app['app_id'] ?? null,
                    'name' => $app['name'] ?? null,
                    'url_label' => $app['url_label'] ?? null,
                    'item_name' => $app['item_name'] ?? null,
                    'status' => $app['status'] ?? null,
                    'item_count' => $app['item_count'] ?? 0,
                ];
            }, $apps);

            return ToolResult::success([
                'apps' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
