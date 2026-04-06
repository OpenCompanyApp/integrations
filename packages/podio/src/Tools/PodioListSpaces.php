<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workspaces (spaces) in a Podio organization.
 *
 * Returns an array of space objects with details like name, URL, and membership info.
 * Use this to discover which workspaces are available before drilling into apps and items.
 */
class PodioListSpaces implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_list_spaces';
    }

    public function description(): string
    {
        return 'List all workspaces (spaces) in a Podio organization. Returns space IDs, names, URLs, and membership details. Use this to discover available workspaces before exploring their apps and items.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio organization ID to list spaces for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $orgId = (int) $args['org_id'];
            $spaces = $this->service->listSpaces($orgId);

            $formatted = array_map(function (array $space): array {
                return [
                    'space_id' => $space['space_id'] ?? null,
                    'name' => $space['name'] ?? null,
                    'url' => $space['url'] ?? null,
                    'url_label' => $space['url_label'] ?? null,
                    'post_on_new_app' => $space['post_on_new_app'] ?? false,
                    'post_on_new_member' => $space['post_on_new_member'] ?? false,
                ];
            }, $spaces);

            return ToolResult::success([
                'spaces' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
