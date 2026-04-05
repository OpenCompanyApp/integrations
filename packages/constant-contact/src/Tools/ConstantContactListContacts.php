<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts
 *
 * Lists contacts from Constant Contact with pagination and optional status filtering.
 * Uses cursor-based pagination as provided by the Constant Contact v3 API.
 */
class ConstantContactListContacts implements Tool
{
    /**
     * @param  ConstantContactService  $service  The Constant Contact API service.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * The unique tool slug.
     */
    public function name(): string
    {
        return 'constantcontact_list_contacts';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'List contacts from Constant Contact. Supports pagination and filtering by status (active, unconfirmed, opted_out, non_subscriber).';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of contacts to return per page (default: 50, max: 500).',
            ],
            'cursor' => [
                'type' => 'string',
                'description' => 'Pagination cursor from a previous response to fetch the next page of results.',
            ],
            'status' => [
                'type' => 'string',
                'description' => 'Filter contacts by status: "all", "active", "unconfirmed", "opted_out", or "non_subscriber".',
                'enum' => ['all', 'active', 'unconfirmed', 'opted_out', 'non_subscriber'],
            ],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, cursor, status).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $result = $this->service->listContacts(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                cursor: $args['cursor'] ?? null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
