<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

use OpenCompany\Integrations\CustomerIO\CustomerIOService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CustomerIOListNewsletters implements Tool
{
    public function __construct(
        private CustomerIOService $service,
    ) {}

    public function name(): string
    {
        return 'customerio_list_newsletters';
    }

    public function description(): string
    {
        return 'List all newsletters in the Customer.io workspace. Newsletters are one-time broadcast messages sent to segments.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Customer.io integration is not configured.');
            }

            $result = $this->service->listNewsletters();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
