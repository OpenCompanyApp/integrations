<?php

namespace OpenCompany\Integrations\ShipBob\Tools;

use OpenCompany\Integrations\ShipBob\ShipBobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single ShipBob order by its ID.
 *
 * Returns full order details including line items, shipping address,
 * fulfillment status, and tracking information.
 */
class ShipBobGetOrder implements Tool
{
    public function __construct(
        private ShipBobService $service,
    ) {}

    public function name(): string
    {
        return 'shipbob_get_order';
    }

    public function description(): string
    {
        return 'Get details for a specific ShipBob order by ID, including line items, shipping address, and fulfillment status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ShipBob order ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ShipBob integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getOrder((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
