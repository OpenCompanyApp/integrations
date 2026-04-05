<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Lists
 *
 * Lists all contact lists in Constant Contact.
 */
class ConstantContactListLists implements Tool
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
        return 'constantcontact_list_lists';
    }

    /**
     * Human-readable description shown in tool catalogs and generated docs.
     */
    public function description(): string
    {
        return 'List all contact lists in Constant Contact. Returns list IDs, names, and membership counts. Use list IDs when creating contacts.';
    }

    /**
     * Parameter definitions for the tool.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list lists tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            $result = $this->service->listLists();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
