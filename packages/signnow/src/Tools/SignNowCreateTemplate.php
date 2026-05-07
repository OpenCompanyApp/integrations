<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a SignNow template from a document.
 */
class SignNowCreateTemplate extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_create_template';
    }

    public function description(): string
    {
        return 'Create a SignNow template from an existing document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Source document ID.'],
            'template_name' => ['type' => 'string', 'description' => 'Optional template name.'],
            'remove_original_document' => ['type' => 'boolean', 'description' => 'Remove the source document after creating the template.'],
        ];
    }

    /**
     * Create a template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['document_id'])) {
                return ToolResult::error('document_id is required.');
            }

            return ToolResult::success($this->service->createTemplate(
                (string) $args['document_id'],
                isset($args['template_name']) && is_scalar($args['template_name']) ? (string) $args['template_name'] : null,
                array_key_exists('remove_original_document', $args) ? (bool) $args['remove_original_document'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
