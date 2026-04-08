<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LemonSqueezyGetOrder implements Tool
{
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_get_order';
    }

    public function description(): string
    {
        return 'Get details for a specific Lemon Squeezy order by ID. Returns full order information including line items, totals, and customer data.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The order ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Order ID is required.');
            }

            $result = $this->service->getOrder($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
