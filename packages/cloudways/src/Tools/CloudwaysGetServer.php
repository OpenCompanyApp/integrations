<?php

namespace OpenCompany\Integrations\Cloudways\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cloudways\CloudwaysService;

class CloudwaysGetServer implements Tool
{
    public function __construct(private CloudwaysService $service) {}

    public function name(): string
    {
        return 'cloudways_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific Cloudways server.';
    }

    public function parameters(): array
    {
        return [
            'server_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The server ID to look up.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudways integration is not configured.');
            }

            $serverId = (int) ($args['server_id'] ?? 0);

            if ($serverId <= 0) {
                return ToolResult::error('A valid server_id is required.');
            }

            $result = $this->service->getServer($serverId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
