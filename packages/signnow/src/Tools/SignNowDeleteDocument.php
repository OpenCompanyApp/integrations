<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a SignNow document.
 */
class SignNowDeleteDocument extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_delete_document';
    }

    public function description(): string
    {
        return 'Delete a SignNow document by ID.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
        ];
    }

    /**
     * Delete a document.
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

            return ToolResult::success($this->service->deleteDocument((string) $args['document_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
