<?php

namespace OpenCompany\Integrations\Tableau\Tools;

use OpenCompany\Integrations\Tableau\TableauService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TableauGetCurrentUser implements Tool
{
    public function __construct(
        private TableauService $service,
    ) {}

    public function name(): string
    {
        return 'tableau_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Tableau user, including name, email, site role, and auth settings.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tableau integration is not configured. Ensure access_token and site_id are set.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
