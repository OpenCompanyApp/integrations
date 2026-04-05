<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_list_contacts
 *
 * Lists contacts (customers and vendors) from Zoho Books with
 * optional filtering by contact type and pagination.
 */
class ZohoBooksListContacts implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_list_contacts';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List contacts (customers and vendors) from Zoho Books. Returns a paginated list with optional filters.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'contact_type' => ['type' => 'string', 'description' => 'Filter by type: customer, vendor, or all (default: all).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, inactive, or all.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page (default: 25, max: 200).'],
            'search_text' => ['type' => 'string', 'description' => 'Search contacts by name or email.'],
        ];
    }

    /**
     * Execute the tool call — list contacts from Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $params = [];

            if (isset($args['contact_type'])) {
                $params['contact_type'] = $args['contact_type'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 200);
            }
            if (isset($args['search_text'])) {
                $params['search_text'] = $args['search_text'];
            }

            $result = $this->service->listContacts($params);

            $contacts = $result['contacts'] ?? [];
            $pageContext = $result['page_context'] ?? [];

            return ToolResult::success([
                'contacts' => $contacts,
                'total' => $pageContext['total'] ?? count($contacts),
                'page' => $pageContext['page'] ?? 1,
                'per_page' => $pageContext['per_page'] ?? 25,
                'has_more' => $pageContext['has_more_page'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
