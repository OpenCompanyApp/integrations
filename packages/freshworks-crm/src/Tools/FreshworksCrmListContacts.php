<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

use OpenCompany\Integrations\FreshworksCrm\FreshworksCrmService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshworksCrmListContacts implements Tool
{
    public function __construct(
        private FreshworksCrmService $service,
    ) {}

    public function name(): string
    {
        return 'freshworks_crm_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts in Freshworks CRM. Returns paginated results with contact details including name, email, phone, and company.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 20, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshworks CRM integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;

            $result = $this->service->listContacts($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
