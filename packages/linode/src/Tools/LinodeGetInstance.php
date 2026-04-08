<?php

namespace OpenCompany\Integrations\Linode\Tools;

use OpenCompany\Integrations\Linode\LinodeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LinodeGetInstance implements Tool
{
    public function __construct(
        private LinodeService $service,
    ) {}

    public function name(): string
    {
        return 'linode_get_instance';
    }

    public function description(): string
    {
        return 'Get details for a specific Linode instance by ID. Returns full instance information including specs, networking, and disk config.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Linode instance ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Linode integration is not configured.');
            }

            $result = $this->service->getInstance((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
