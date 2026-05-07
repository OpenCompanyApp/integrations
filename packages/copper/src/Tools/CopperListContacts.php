<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search Copper people.
 */
class CopperListContacts implements Tool
{
    /**
     * @param  CopperService  $service  The Copper API client.
     */
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_list_contacts';
    }

    public function description(): string
    {
        return 'Search and list contacts in Copper CRM. Returns contact names, emails, and IDs.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of contacts to return per page (default: 25, max: 200).'],
            'sort_by' => ['type' => 'string', 'description' => 'Field to sort by (e.g., "name", "created_at").'],
        ];
    }

    /**
     * Search Copper people.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            $params = [];
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }
            if (isset($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }

            $result = $this->service->listContacts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
