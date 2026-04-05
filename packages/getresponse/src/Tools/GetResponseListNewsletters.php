<?php

namespace OpenCompany\Integrations\GetResponse\Tools;

use OpenCompany\Integrations\GetResponse\GetResponseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GetResponseListNewsletters implements Tool
{
    public function __construct(
        private GetResponseService $service,
    ) {}

    public function name(): string
    {
        return 'getresponse_list_newsletters';
    }

    public function description(): string
    {
        return 'List newsletters in your GetResponse account. Returns newsletter details including subject, status, and send dates.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GetResponse integration is not configured.');
            }

            $result = $this->service->listNewsletters();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
