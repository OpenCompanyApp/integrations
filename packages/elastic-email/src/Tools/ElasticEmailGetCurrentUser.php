<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticEmailGetCurrentUser implements Tool
{
    public function __construct(
        private ElasticEmailService $service,
    ) {}

    public function name(): string
    {
        return 'elasticemail_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Elastic Email user account.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
