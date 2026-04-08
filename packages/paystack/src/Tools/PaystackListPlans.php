<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaystackListPlans implements Tool
{
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_list_plans';
    }

    public function description(): string
    {
        return 'List subscription plans on your Paystack integration. Supports filtering by status and pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of plans per page (default: 50, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number to retrieve.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "active" or "inactive".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['perPage'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listPlans($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
