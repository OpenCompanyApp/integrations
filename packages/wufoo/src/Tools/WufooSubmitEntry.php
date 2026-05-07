<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Submit a new entry to a Wufoo form.
 *
 * Accepts field values keyed by Wufoo API field IDs such as Field1 and Field2.
 */
class WufooSubmitEntry implements Tool
{
    /**
     * Create a new WufooSubmitEntry tool instance.
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
        return 'wufoo_submit_entry';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'Submit a new entry to a Wufoo form. Provide field values keyed by their API field IDs (e.g., Field1, Field2). Use list_fields to discover the field IDs for a form.';
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
            'fields' => ['type' => 'object', 'required' => true, 'description' => 'Object mapping field API IDs to their values (e.g., {"Field1": "John", "Field2": "john@example.com"}). Use list_fields to discover field IDs.'],
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

            $fields = $args['fields'] ?? [];

            if (!is_array($fields) || empty($fields)) {
                return ToolResult::error('The fields parameter must contain at least one field value.');
            }

            $result = $this->service->submitEntry($formId, $fields);

            $success = $result['Success'] ?? false;

            if (!$success) {
                $errors = $result['Errors'] ?? [];
                $errorMsg = !empty($errors)
                    ? implode('; ', array_map(fn ($e) => ($e['Error'] ?? $e['Message'] ?? json_encode($e)), $errors))
                    : 'Unknown error submitting entry.';
                return ToolResult::error("Failed to submit entry: {$errorMsg}");
            }

            $entryId = $result['EntryId'] ?? $result['EntryLink'] ?? null;

            return ToolResult::success([
                'success' => true,
                'entry_id' => $entryId,
                'message' => 'Entry submitted successfully.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
