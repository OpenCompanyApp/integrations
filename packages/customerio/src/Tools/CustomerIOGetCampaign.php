<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOGetCampaign implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_get_campaign';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific campaign in Customer.io, including its triggers, actions, and performance metrics.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The campaign ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $result = $this->service->getCampaign((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
