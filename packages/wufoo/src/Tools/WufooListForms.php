<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WufooListForms implements Tool
{
    /**
     * Create a new WufooListForms tool instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool's machine name.
     */
    public function name(): string
    {
        return 'wufoo_list_forms';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'List all forms in the Wufoo account. Returns form hashes, names, descriptions, entry counts, and URLs.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->listForms();
            $forms = $result['Forms'] ?? [];

            return ToolResult::success([
                'forms' => $forms,
                'total' => count($forms),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
