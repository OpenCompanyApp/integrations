<?php

namespace OpenCompany\Integrations\Hostinger\Tools;

use OpenCompany\Integrations\Hostinger\HostingerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HostingerGetServer implements Tool
{
    public function __construct(
        private HostingerService $service,
    ) {}

    public function name(): string
    {
        return 'hostinger_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific Hostinger VPS server by ID. Returns full server information including IP addresses, plan, and status.';
    }

    public function parameters(): array
    {
        return [
            'server_id' => ['type' => 'integer', 'required' => true, 'description' => 'The VPS server ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hostinger integration is not configured.');
            }

            $result = $this->service->getServer((int) $args['server_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
