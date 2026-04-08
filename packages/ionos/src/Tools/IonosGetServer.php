<?php

namespace OpenCompany\Integrations\Ionos\Tools;

use OpenCompany\Integrations\Ionos\IonosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class IonosGetServer implements Tool
{
    public function __construct(
        private IonosService $service,
    ) {}

    public function name(): string
    {
        return 'ionos_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific IONOS Cloud server by ID. Returns full server information including cores, RAM, VM state, volumes, and NICs.';
    }

    public function parameters(): array
    {
        return [
            'server_id' => ['type' => 'string', 'required' => true, 'description' => 'The server ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IONOS integration is not configured.');
            }

            $result = $this->service->getServer((string) $args['server_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
