<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SquareCreatePayment implements Tool
{
    /**
     * Create a new SquareCreatePayment tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_create_payment';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new payment in Square. Requires a payment source ID (e.g., a card nonce or card-on-file ID), an idempotency key, and the amount with currency.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'source_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the payment source (card nonce, card-on-file ID, or payment token).'],
            'idempotency_key' => ['type' => 'string', 'required' => true, 'description' => 'A unique string to ensure idempotent processing (e.g., a UUID).'],
            'amount' => ['type' => 'integer', 'required' => true, 'description' => 'The payment amount in the smallest currency unit (e.g., cents). For $10.00, use 1000.'],
            'currency' => ['type' => 'string', 'required' => true, 'description' => 'The currency code (e.g., "USD", "EUR", "GBP").'],
            'reference_id' => ['type' => 'string', 'description' => 'An optional reference ID for the payment (e.g., an order or invoice number).'],
            'note' => ['type' => 'string', 'description' => 'An optional note attached to the payment.'],
            'customer_id' => ['type' => 'string', 'description' => 'The Square customer ID to associate with this payment.'],
            'location_id' => ['type' => 'string', 'description' => 'The Square location ID where the payment is processed.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $sourceId = $args['source_id'] ?? '';
            $idempotencyKey = $args['idempotency_key'] ?? '';
            $amount = $args['amount'] ?? null;
            $currency = $args['currency'] ?? '';

            if (empty($sourceId)) {
                return ToolResult::error('source_id is required.');
            }
            if (empty($idempotencyKey)) {
                return ToolResult::error('idempotency_key is required.');
            }
            if ($amount === null || !is_numeric($amount)) {
                return ToolResult::error('amount is required and must be a number.');
            }
            if (empty($currency)) {
                return ToolResult::error('currency is required.');
            }

            $data = [
                'source_id' => $sourceId,
                'idempotency_key' => $idempotencyKey,
                'amount_money' => [
                    'amount' => (int) $amount,
                    'currency' => strtoupper($currency),
                ],
            ];

            if (isset($args['reference_id'])) {
                $data['reference_id'] = $args['reference_id'];
            }
            if (isset($args['note'])) {
                $data['note'] = $args['note'];
            }
            if (isset($args['customer_id'])) {
                $data['customer_id'] = $args['customer_id'];
            }
            if (isset($args['location_id'])) {
                $data['location_id'] = $args['location_id'];
            }

            $result = $this->service->createPayment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
