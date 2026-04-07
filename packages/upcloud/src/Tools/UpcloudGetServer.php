<?php

namespace OpenCompany\Integrations\Upcloud\Tools;

use OpenCompany\Integrations\Upcloud\UpcloudService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific UpCloud server.
 *
 * Retrieves full details for a single server by its UUID, including
 * configuration, networking, storage devices, and state.
 */
class UpcloudGetServer implements Tool
{
    public function __construct(
        private UpcloudService $service,
    ) {}

    public function name(): string
    {
        return 'upcloud_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific UpCloud server by UUID.';
    }

    public function parameters(): array
    {
        return [
            'uuid' => ['type' => 'string', 'required' => true, 'description' => 'The server UUID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('UpCloud integration is not configured.');
            }

            if (!isset($args['uuid'])) {
                return ToolResult::error('Server UUID is required.');
            }

            $result = $this->service->getServer((string) $args['uuid']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
