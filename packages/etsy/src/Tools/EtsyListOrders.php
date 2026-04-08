<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\Integrations\Etsy\EtsyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List orders (receipts) for the Etsy shop with pagination.
 */
class EtsyListOrders implements Tool
{
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_list_orders';
    }

    public function description(): string
    {
        return 'List orders (receipts) for the Etsy shop. Returns paginated order data including buyer info, items, and totals.';
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of receipts to return per page (1–100, default: 25).',
            ],
            'offset' => [
                'type' => 'integer',
                'description' => 'Offset for pagination — pass the offset from a previous response to get the next page.',
            ],
            'was_paid' => [
                'type' => 'boolean',
                'description' => 'Filter to only paid receipts (true) or unpaid (false).',
            ],
            'was_shipped' => [
                'type' => 'boolean',
                'description' => 'Filter to only shipped receipts (true) or unshipped (false).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['was_paid'])) {
                $params['was_paid'] = (bool) $args['was_paid'];
            }
            if (isset($args['was_shipped'])) {
                $params['was_shipped'] = (bool) $args['was_shipped'];
            }

            $result = $this->service->listOrders($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
