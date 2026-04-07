<?php

namespace OpenCompany\Integrations\Sellfy\Tools;

use OpenCompany\Integrations\Sellfy\SellfyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SellfyGetProduct implements Tool
{
    public function __construct(
        private SellfyService $service,
    ) {}

    public function name(): string
    {
        return 'sellfy_get_product';
    }

    public function description(): string
    {
        return 'Get details for a specific Sellfy product by ID. Returns full product information including pricing, description, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The product ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sellfy integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Product ID is required.');
            }

            $result = $this->service->getProduct($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
