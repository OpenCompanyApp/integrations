<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_create_item
 *
 * Creates a new item (product or service) in Zoho Books.
 * Requires a name and rate.
 */
class ZohoBooksCreateItem implements Tool
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
        return 'zohobooks_create_item';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new item (product or service) in Zoho Books. Requires a name and rate. Optionally specify item type, description, unit, and tax.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Item name (e.g., "Web Design Service" or "Widget A").'],
            'rate' => ['type' => 'number', 'required' => true, 'description' => 'Unit price or hourly rate.'],
            'description' => ['type' => 'string', 'description' => 'Item description shown on invoices.'],
            'unit' => ['type' => 'string', 'description' => 'Unit of measurement (e.g., "hrs", "pcs", "kg").'],
            'item_type' => ['type' => 'string', 'description' => 'Type of item: sales, purchases, or both (default: both).'],
            'tax_id' => ['type' => 'string', 'description' => 'Tax ID to apply to this item.'],
            'sku' => ['type' => 'string', 'description' => 'Stock Keeping Unit identifier.'],
        ];
    }

    /**
     * Execute the tool call — create an item in Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $name = $args['name'] ?? '';
            $rate = $args['rate'] ?? null;

            if (empty($name)) {
                return ToolResult::error('name is required to create an item.');
            }

            if ($rate === null) {
                return ToolResult::error('rate is required to create an item.');
            }

            $data = [
                'name' => $name,
                'rate' => (float) $rate,
            ];

            $optionalFields = ['description', 'unit', 'item_type', 'tax_id', 'sku'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            $result = $this->service->createItem($data);
            $item = $result['item'] ?? $result;

            return ToolResult::success([
                'message' => 'Item created successfully.',
                'item' => $item,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
