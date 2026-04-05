<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts
 *
 * Lists contacts from Insightly CRM with optional pagination, ordering, and filtering.
 *
 * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntities
 */
class InsightlyListContacts implements Tool
{
    /**
     * Create a new InsightlyListContacts tool instance.
     *
     * @param  InsightlyService  $service  The Insightly API service.
     */
    public function __construct(
        private InsightlyService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'insightly_list_contacts';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List contacts from Insightly CRM. Returns contact records with names, emails, phones, and organization info. Use pagination parameters to browse large result sets.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: all).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of contacts to skip for pagination.'],
            'order_by' => ['type' => 'string', 'description' => 'Field to order by (e.g., "DATE_CREATED_UTC desc", "CONTACT_ID asc").'],
            'filter' => ['type' => 'string', 'description' => 'Insightly filter expression (e.g., "FIRST_NAME eq \'John\'").'],
            'brief' => ['type' => 'boolean', 'description' => 'Set to true for a reduced payload with only key fields.'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, order_by, filter, brief).
     * @return ToolResult The list of contacts or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Insightly integration is not configured.');
            }

            $result = $this->service->listContacts(
                top: isset($args['top']) ? (int) $args['top'] : null,
                skip: isset($args['skip']) ? (int) $args['skip'] : null,
                brief: isset($args['brief']) ? ($args['brief'] ? 'true' : null) : null,
                orderBy: $args['order_by'] ?? null,
                filter: $args['filter'] ?? null,
            );

            return ToolResult::success([
                'contacts' => $result,
                'count' => count($result),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
