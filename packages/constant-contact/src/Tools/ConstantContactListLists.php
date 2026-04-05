<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all contact lists in Constant Contact.
 *
 * Returns all contact lists in the account with their names,
 * membership counts, and dates.
 */
class ConstantContactListLists implements Tool
{
    /**
     * Create a new ConstantContactListLists tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_list_lists';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all contact lists in your Constant Contact account.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: list contact lists from Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
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
