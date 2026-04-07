<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single transaction from TaxJar by ID.
 *
 * Returns detailed transaction information including amount, tax, shipping,
 * line items, and addresses.
 */
class TaxjarGetTransaction implements Tool
{
    /**
     * Create a new TaxjarGetTransaction tool instance.
     *
     * @param  TaxjarService  $service  The TaxJar API service.
     */
    public function __construct(
        private TaxjarService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'taxjar_get_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific TaxJar transaction by its ID, including amount, tax, shipping, line items, and addresses.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The transaction ID.'],
        ];
    }

    /**
     * Execute the get transaction request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TaxJar integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Transaction ID is required.');
            }

            $result = $this->service->getTransaction($args['id']);

            $transaction = $result['transaction'] ?? $result;

            return ToolResult::success(['transaction' => $transaction]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
