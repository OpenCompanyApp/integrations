<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Place a DFY email account order.
 */
class InstantlyCreateDfyOrder implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_dfy_order';
    }

    public function description(): string
    {
        return 'Place a DFY email account order.';
    }

    public function parameters(): array
    {
        return [
            'items' => ['type' => 'string', 'required' => true, 'description' => 'JSON order items'],
            'order_type' => ['type' => 'string', 'required' => true, 'description' => 'dfy, pre_warmed_up, or extra_accounts'],
            'simulation' => ['type' => 'boolean', 'required' => false, 'description' => 'Simulate without ordering'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $items = $args['items']; if (is_string($items)) $items = json_decode($items, true); $body = ['items' => $items, 'order_type' => $args['order_type']]; if (isset($args['simulation'])) $body['simulation'] = $args['simulation']; $result = $this->service->createDfyOrder($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
