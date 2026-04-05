<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Productboard feature by its ID.
 *
 * Retrieves the full details of a feature including its name,
 * description, status, assigned product/component, and any
 * linked notes or sub-features.
 */
class ProductboardGetFeature implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_get_feature';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Productboard feature by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The feature ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Productboard integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Feature ID is required.');
            }

            $result = $this->service->getFeature($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
