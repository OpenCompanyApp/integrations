<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts from Keap CRM with pagination.
 *
 * Returns a paginated list of contacts. Use `page` and `limit` to control
 * pagination. Each contact includes basic fields such as name, email, and
 * company.
 */
class KeapListContacts implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from Keap CRM. Returns paginated results with contact details including name, email, and company.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 20, max: 200).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listContacts($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
