<?php

namespace OpenCompany\Integrations\PowerBi\Tools;

use OpenCompany\Integrations\PowerBi\PowerBiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Power BI workspace (group) by its ID.
 *
 * Returns a single workspace object including id, name, isReadOnly,
 * isOnDedicatedCapacity, capacityId, and other metadata.
 */
class PowerBiGetWorkspace implements Tool
{
    public function __construct(
        private PowerBiService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_workspace';
    }

    public function description(): string
    {
        return 'Get details for a specific Power BI workspace (group) by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace (group) ID (a GUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->getWorkspace($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
