<?php

namespace OpenCompany\Integrations\Scaleway\Tools;

use OpenCompany\Integrations\Scaleway\ScalewayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ScalewayGetServer implements Tool
{
    public function __construct(
        private ScalewayService $service,
    ) {}

    public function name(): string
    {
        return 'scaleway_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific Scaleway server by ID. Returns full server information including image, volumes, and public IP.';
    }

    public function parameters(): array
    {
        return [
            'server_id' => ['type' => 'string', 'required' => true, 'description' => 'The server ID (UUID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Scaleway integration is not configured.');
            }

            $result = $this->service->getServer($args['server_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
