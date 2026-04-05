<?php

namespace OpenCompany\Integrations\ZohoDesk\Tools;

use OpenCompany\Integrations\ZohoDesk\ZohoDeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohodesk_list_contacts
 *
 * List customer contacts from Zoho Desk.
 */
class ZohoDeskListContacts implements Tool
{
    /**
     * @param  ZohoDeskService  $service  The Zoho Desk API service instance.
     */
    public function __construct(
        private ZohoDeskService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'zohodesk_list_contacts';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List customer contacts from Zoho Desk. Supports search and pagination.';
    }

    /**
     * The parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by name or email.'],
            'from' => ['type' => 'integer', 'description' => 'Pagination offset (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'sortBy' => ['type' => 'string', 'description' => 'Sort field (e.g., "firstName", "lastName", "createdTime").'],
            'sortOrder' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    /**
     * Execute the tool — list contacts from Zoho Desk.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoho Desk integration is not configured.');
            }

            $params = array_filter([
                'search' => $args['search'] ?? null,
                'from' => $args['from'] ?? null,
                'limit' => $args['limit'] ?? null,
                'sortBy' => $args['sortBy'] ?? null,
                'sortOrder' => $args['sortOrder'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->listContacts($params);

            $contacts = $result['data'] ?? $result['contacts'] ?? $result;

            return ToolResult::success(is_array($contacts) ? $contacts : [$contacts]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
