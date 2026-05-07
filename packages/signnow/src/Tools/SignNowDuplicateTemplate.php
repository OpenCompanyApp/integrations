<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Duplicate a SignNow template into a document.
 */
class SignNowDuplicateTemplate extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_duplicate_template';
    }

    public function description(): string
    {
        return 'Duplicate a SignNow template into a new document.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
            'document_name' => ['type' => 'string', 'description' => 'Optional name for the duplicated document.'],
        ];
    }

    /**
     * Duplicate a template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['template_id'])) {
                return ToolResult::error('template_id is required.');
            }

            $documentName = isset($args['document_name']) && is_scalar($args['document_name']) ? (string) $args['document_name'] : null;

            return ToolResult::success($this->service->duplicateTemplate((string) $args['template_id'], $documentName));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
