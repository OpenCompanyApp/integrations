<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all forms in the authenticated Wufoo account.
 *
 * Calls GET /forms.json on the Wufoo API and returns an array of form objects
 * including form identifiers, names, descriptions, and metadata.
 */
class WufooListForms implements Tool
{
    /**
     * Create a new WufooListForms tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_list_forms';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all forms in your Wufoo account. Returns form identifiers, names, descriptions, and metadata that can be used with other Wufoo tools.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list forms operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments (none required).
     * @return ToolResult The result containing the list of forms or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->listForms();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
