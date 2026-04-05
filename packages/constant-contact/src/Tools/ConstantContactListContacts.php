<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts in Constant Contact with optional status filtering.
 *
 * Returns a paginated list of contacts from the Constant Contact account.
 * Supports customizable limit and status filtering.
 */
class ConstantContactListContacts implements Tool
{
    /**
     * Create a new ConstantContactListContacts tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_list_contacts';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List contacts from your Constant Contact account. Supports limit and status filtering (active, unconfirmed, opted_out, pending).';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (max 500, default 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "active", "unconfirmed", "opted_out", or "pending".'],
        ];
    }

    /**
     * Execute the tool: list contacts from Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $status = $args['status'] ?? null;

            $result = $this->service->listContacts($limit, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
