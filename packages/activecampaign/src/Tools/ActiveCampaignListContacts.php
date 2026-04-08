<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list contacts from ActiveCampaign with pagination, search, and filters.
 */
class ActiveCampaignListContacts implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_list_contacts';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List contacts from ActiveCampaign. Supports pagination, search by email or name, and filtering by list, status, and other criteria.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of contacts to return per page (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (e.g., 20 to skip the first page).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by email, name, or other fields.'],
            'filters' => ['type' => 'object', 'description' => 'Additional filters as key-value pairs (e.g., {"status": "-1"} for unsubscribed, {"listid": 5}).'],
        ];
    }

    /**
     * Execute the tool: list contacts from ActiveCampaign.
     *
     * @param  array $args The tool arguments (limit, offset, search, filters).
     * @return ToolResult  The result containing contacts or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $result = $this->service->listContacts(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
                search: $args['search'] ?? null,
                filters: $args['filters'] ?? [],
            );

            $contacts = $result['contacts'] ?? [];
            $meta = $result['meta'] ?? [];

            $response = [
                'contacts' => array_map(fn(array $c) => [
                    'id' => (int) ($c['id'] ?? 0),
                    'email' => $c['email'] ?? '',
                    'firstName' => $c['firstName'] ?? '',
                    'lastName' => $c['lastName'] ?? '',
                    'phone' => $c['phone'] ?? '',
                    'created' => $c['createdTimestamp'] ?? $c['cdate'] ?? null,
                    'updated' => $c['updatedTimestamp'] ?? $c['udate'] ?? null,
                ], $contacts),
                'total' => $meta['total'] ?? count($contacts),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
