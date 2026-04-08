<?php

namespace OpenCompany\Integrations\Kamatera\Tools;

use OpenCompany\Integrations\Kamatera\KamateraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KamateraGetServer implements Tool
{
    public function __construct(
        private KamateraService $service,
    ) {}

    public function name(): string
    {
        return 'kamatera_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific Kamatera cloud server by ID. Returns full server information including status, CPU, RAM, disk, and IP addresses.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The server ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kamatera integration is not configured.');
            }

            $result = $this->service->getServer((string) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
