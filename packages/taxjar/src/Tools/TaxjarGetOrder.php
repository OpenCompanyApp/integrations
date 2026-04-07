<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single order transaction from TaxJar by ID.
 *
 * Returns detailed order information including amount, tax, shipping,
 * line items, and addresses.
 */
class TaxjarGetOrder implements Tool
{
    /**
     * Create a new TaxjarGetOrder tool instance.
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
        return 'taxjar_get_order';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Retrieve detailed information about a specific TaxJar order transaction by its ID, including amount, tax, shipping, line items, and addresses.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The order transaction ID.'],
        ];
    }

    /**
     * Execute the get order request.
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
                return ToolResult::error('Order ID is required.');
            }

            $result = $this->service->getOrder($args['id']);

            $order = $result['order'] ?? $result;

            return ToolResult::success(['order' => $order]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
