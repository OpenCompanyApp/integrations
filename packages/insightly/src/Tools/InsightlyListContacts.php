<?php

namespace OpenCompany\Integrations\Insightly\Tools;

use OpenCompany\Integrations\Insightly\InsightlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts
 *
 * Lists contacts from Insightly CRM with optional pagination and search.
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
        return 'List contacts from Insightly CRM. Returns contact records with names, emails, phones, and organization info. Use top/skip for pagination and search to filter by name or email.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return.'],
            'skip' => ['type' => 'integer', 'description' => 'Number of contacts to skip for pagination.'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by name or email.'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip, search).
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
                search: $args['search'] ?? null,
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
