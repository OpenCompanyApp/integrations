<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new feature in Productboard.
 *
 * Creates a feature with the provided name, description, and optional
 * properties such as product assignment, status, and owner. The feature
 * will appear in the Productboard feature board.
 */
class ProductboardCreateFeature implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_create_feature';
    }

    public function description(): string
    {
        return 'Create a new feature in Productboard. Requires at minimum a name. Optionally set description, product, status, and owner.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The feature name.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the feature.'],
            'product_id' => ['type' => 'string', 'description' => 'ID of the product to assign this feature to.'],
            'status' => ['type' => 'string', 'description' => 'Feature status (e.g., "in_discovery", "in_design", "in_development", "shipped"). Must match a status configured in your Productboard workspace.'],
            'owner_ids' => ['type' => 'array', 'description' => 'Array of user IDs to assign as feature owners.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Productboard integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Feature name is required.');
            }

            $data = ['name' => $args['name']];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }

            if (isset($args['product_id'])) {
                $data['product_id'] = $args['product_id'];
            }

            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }

            if (isset($args['owner_ids'])) {
                $data['owner_ids'] = $args['owner_ids'];
            }

            $result = $this->service->createFeature($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
