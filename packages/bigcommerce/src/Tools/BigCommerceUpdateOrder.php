<?php

namespace OpenCompany\Integrations\BigCommerce\Tools;

use OpenCompany\Integrations\BigCommerce\BigCommerceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing order in the BigCommerce store.
 *
 * Only the fields provided in the request will be updated.
 */
class BigCommerceUpdateOrder implements Tool
{
    public function __construct(
        private BigCommerceService $service,
    ) {}

    public function name(): string
    {
        return 'bigcommerce_update_order';
    }

    public function description(): string
    {
        return 'Update an existing order in the BigCommerce store. Use to change status, tracking info, or staff notes. Only the fields you provide will be changed.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The order ID to update.'],
            'status_id' => ['type' => 'integer', 'description' => 'Order status ID (0=Incomplete, 1=Pending, 2=Awaiting Shipment, 3=Shipped, 4=Completed, 5=Cancelled, 6=Declined, 7=Refunded).'],
            'staff_notes' => ['type' => 'string', 'description' => 'Internal staff notes (not visible to customers).'],
            'customer_message' => ['type' => 'string', 'description' => 'Message from the customer.'],
            'is_deleted' => ['type' => 'boolean', 'description' => 'Whether the order is deleted (archived).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BigCommerce integration is not configured.');
            }

            $orderId = (int) $args['id'];
            $data = [];

            $updatableFields = ['status_id', 'staff_notes', 'customer_message', 'is_deleted'];

            foreach ($updatableFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $field === 'status_id' ? (int) $args[$field] : $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update. Provide at least one field besides "id".');
            }

            $result = $this->service->updateOrder($orderId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
