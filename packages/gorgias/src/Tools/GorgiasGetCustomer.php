<?php

namespace OpenCompany\Integrations\Gorgias\Tools;

use OpenCompany\Integrations\Gorgias\GorgiasService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GorgiasGetCustomer implements Tool
{
    public function __construct(
        private GorgiasService $service,
    ) {}

    public function name(): string
    {
        return 'gorgias_get_customer';
    }

    public function description(): string
    {
        return 'Get details of a specific Gorgias customer by ID, including name, email, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gorgias integration is not configured.');
            }

            $result = $this->service->getCustomer($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
