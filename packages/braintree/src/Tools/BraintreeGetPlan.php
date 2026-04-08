<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeGetPlan implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_get_plan';
    }

    public function description(): string
    {
        return 'Retrieve a single Braintree recurring billing plan by ID. Returns plan details including billing cycle, price, and trial period.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The plan ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Plan ID is required.');
            }

            $result = $this->service->getPlan($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
