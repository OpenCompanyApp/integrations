<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Square payment by ID.
 *
 * Returns full payment details including amount, status, card info, and fees.
 */
class SquareGetPayment implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_get_payment';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Square payment by ID.
        Returns full payment details including amount, status, card details, and processing fees.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Square payment ID.'],
        ];
    }

    /**
     * Retrieve a Square payment by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getPayment($id);
            $payment = $result['payment'] ?? [];

            return ToolResult::success([
                'id' => $payment['id'] ?? '',
                'amount_money' => $payment['amount_money'] ?? [],
                'tip_money' => $payment['tip_money'] ?? null,
                'total_money' => $payment['total_money'] ?? [],
                'app_fee_money' => $payment['app_fee_money'] ?? null,
                'status' => $payment['status'] ?? '',
                'source_type' => $payment['source_type'] ?? '',
                'card_details' => $payment['card_details'] ?? null,
                'processing_fee' => $payment['processing_fee'] ?? [],
                'order_id' => $payment['order_id'] ?? null,
                'customer_id' => $payment['customer_id'] ?? null,
                'created_at' => $payment['created_at'] ?? null,
                'updated_at' => $payment['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
