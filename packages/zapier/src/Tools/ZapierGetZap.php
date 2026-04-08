<?php

namespace OpenCompany\Integrations\Zapier\Tools;

use OpenCompany\Integrations\Zapier\ZapierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Zapier zap.
 */
class ZapierGetZap implements Tool
{
    /**
     * @param  ZapierService  $service  The Zapier API client
     */
    public function __construct(
        private ZapierService $service,
    ) {}

    public function name(): string
    {
        return 'zapier_get_zap';
    }

    public function description(): string
    {
        return 'Get detailed information about a Zapier zap.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The zap ID.'],
        ];
    }

    /**
     * Retrieve a zap by its ID.
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

            $zap = $this->service->getZap($id);

            return ToolResult::success($zap);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
