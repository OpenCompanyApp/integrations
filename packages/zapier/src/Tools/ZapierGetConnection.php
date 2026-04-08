<?php

namespace OpenCompany\Integrations\Zapier\Tools;

use OpenCompany\Integrations\Zapier\ZapierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Zapier connection.
 */
class ZapierGetConnection implements Tool
{
    /**
     * @param  ZapierService  $service  The Zapier API client
     */
    public function __construct(
        private ZapierService $service,
    ) {}

    public function name(): string
    {
        return 'zapier_get_connection';
    }

    public function description(): string
    {
        return 'Get detailed information about a Zapier connection.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The connection ID.'],
        ];
    }

    /**
     * Retrieve a connection by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zapier integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $connection = $this->service->getConnection($id);

            return ToolResult::success($connection);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
