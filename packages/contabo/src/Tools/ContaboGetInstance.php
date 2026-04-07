<?php

namespace OpenCompany\Integrations\Contabo\Tools;

use OpenCompany\Integrations\Contabo\ContaboService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ContaboGetInstance implements Tool
{
    public function __construct(
        private ContaboService $service,
    ) {}

    public function name(): string
    {
        return 'contabo_get_instance';
    }

    public function description(): string
    {
        return 'Get details for a specific Contabo compute instance (VPS) by ID. Returns full instance information including IP addresses, region, and configuration.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The instance ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Contabo integration is not configured.');
            }

            $result = $this->service->getInstance((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
