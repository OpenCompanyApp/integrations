<?php

namespace OpenCompany\Integrations\Wise\Tools;

use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Wise transfer.
 *
 * Initiates a money transfer from a Wise quote to a recipient account.
 *
 * Requires the target account, V2 quote UUID, and customer transaction ID used
 * for idempotency. Optionally includes a refund source account and reference.
 */
class WiseCreateTransfer implements Tool
{
    /**
     * Create a new WiseCreateTransfer instance.
     *
     * @param WiseService $service The Wise API service client.
     */
    public function __construct(
        private WiseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'wise_create_transfer';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Create a new money transfer on Wise.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'source_account' => ['type' => 'integer', 'description' => 'Optional refund recipient source account ID.'],
            'target_account' => ['type' => 'integer', 'description' => 'Target account ID (recipient account to credit).', 'required' => true],
            'quote_uuid' => ['type' => 'string', 'description' => 'V2 quote UUID for this transfer.', 'required' => true],
            'customer_transaction_id' => ['type' => 'string', 'description' => 'UUID used for idempotency when creating the transfer.', 'required' => true],
            'reference' => ['type' => 'string', 'description' => 'Payment reference or description for the transfer.'],
            'details' => ['type' => 'object', 'description' => 'Additional transfer details returned by Wise transfer-requirements.'],
        ];
    }

    /**
     * Execute the tool — create a new transfer.
     *
     * @param array $args Tool arguments containing source_account, target_account, amount, and optional reference.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wise integration is not configured.');
            }

            $targetAccount = $args['target_account'] ?? null;
            $quoteUuid = $args['quote_uuid'] ?? null;
            $customerTransactionId = $args['customer_transaction_id'] ?? null;

            if (empty($targetAccount)) {
                return ToolResult::error('Parameter "target_account" is required.');
            }
            if (empty($quoteUuid)) {
                return ToolResult::error('Parameter "quote_uuid" is required.');
            }
            if (empty($customerTransactionId)) {
                return ToolResult::error('Parameter "customer_transaction_id" is required.');
            }

            $data = [
                'targetAccount' => $targetAccount,
                'quoteUuid' => $quoteUuid,
                'customerTransactionId' => $customerTransactionId,
                'details' => isset($args['details']) && is_array($args['details']) ? $args['details'] : [],
            ];

            if (isset($args['source_account'])) {
                $data['sourceAccount'] = $args['source_account'];
            }
            if (isset($args['reference'])) {
                $data['details']['reference'] = $args['reference'];
            }

            $transfer = $this->service->createTransfer($data);

            return ToolResult::success($transfer);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
