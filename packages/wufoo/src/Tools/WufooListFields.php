<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List field definitions for a Wufoo form.
 *
 * Returns field API IDs, labels, field types, subfields, and validation metadata.
 */
class WufooListFields implements Tool
{
    /**
     * Create a new WufooListFields tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool's machine name.
     */
    public function name(): string
    {
        return 'wufoo_list_fields';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'List all fields for a specific Wufoo form. Returns field types, labels, API IDs, and validation rules. Use this to discover field IDs before submitting entries.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or unique identifier.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $formId = trim((string) ($args['form_id'] ?? ''));
            if ($formId === '') {
                return ToolResult::error('form_id is required.');
            }

            $result = $this->service->listFields($formId);
            $fields = $result['Fields'] ?? [];

            return ToolResult::success([
                'fields' => $fields,
                'total' => count($fields),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
