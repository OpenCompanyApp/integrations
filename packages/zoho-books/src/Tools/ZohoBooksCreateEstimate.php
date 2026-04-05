<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_create_estimate
 *
 * Creates a new estimate (quote) in Zoho Books. Requires a customer_id
 * and line items, similar to invoice creation.
 */
class ZohoBooksCreateEstimate implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_create_estimate';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new estimate (quote) in Zoho Books. Requires a customer_id and line_items array. Each line item needs at least an item_id or name with a rate and quantity.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The customer (contact) ID for the estimate.'],
            'line_items' => ['type' => 'array', 'required' => true, 'description' => 'Array of line items. Each item should have: item_id (or name), rate, quantity, and optionally description.'],
            'date' => ['type' => 'string', 'description' => 'Estimate date (ISO 8601, e.g., "2025-01-15"). Defaults to today.'],
            'expiry_date' => ['type' => 'string', 'description' => 'Date when the estimate expires (ISO 8601).'],
            'estimate_number' => ['type' => 'string', 'description' => 'Custom estimate number. Auto-generated if omitted.'],
            'reference_number' => ['type' => 'string', 'description' => 'Reference number.'],
            'notes' => ['type' => 'string', 'description' => 'Notes to display on the estimate.'],
            'terms' => ['type' => 'string', 'description' => 'Terms and conditions.'],
        ];
    }

    /**
     * Execute the tool call — create an estimate in Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $customerId = $args['customer_id'] ?? '';
            $lineItems = $args['line_items'] ?? [];

            if (empty($customerId)) {
                return ToolResult::error('customer_id is required to create an estimate.');
            }

            if (empty($lineItems)) {
                return ToolResult::error('line_items is required to create an estimate. Provide at least one line item.');
            }

            $data = [
                'customer_id' => $customerId,
                'line_items' => $lineItems,
            ];

            $optionalFields = ['date', 'expiry_date', 'estimate_number', 'reference_number', 'notes', 'terms'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createEstimate($data);
            $estimate = $result['estimate'] ?? $result;

            return ToolResult::success([
                'message' => 'Estimate created successfully.',
                'estimate' => $estimate,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
