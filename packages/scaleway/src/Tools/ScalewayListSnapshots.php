<?php

namespace OpenCompany\Integrations\Scaleway\Tools;

use OpenCompany\Integrations\Scaleway\ScalewayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ScalewayListSnapshots implements Tool
{
    public function __construct(
        private ScalewayService $service,
    ) {}

    public function name(): string
    {
        return 'scaleway_list_snapshots';
    }

    public function description(): string
    {
        return 'List all volume snapshots in the Scaleway zone. Returns IDs, names, size, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of snapshots per page (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Scaleway integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : null;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : null;

            $result = $this->service->listSnapshots($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
