<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Merge SignNow documents.
 */
class SignNowMergeDocuments extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_merge_documents';
    }

    public function description(): string
    {
        return 'Merge multiple SignNow documents into a new document.';
    }

    public function parameters(): array
    {
        return [
            'document_ids' => ['type' => 'array', 'required' => true, 'description' => 'Document IDs to merge.'],
            'name' => ['type' => 'string', 'description' => 'Merged document name.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official merge fields.'],
        ];
    }

    /**
     * Merge documents.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!is_array($args['document_ids'] ?? null) || $args['document_ids'] === []) {
                return ToolResult::error('document_ids is required.');
            }

            $payload = $this->payload($args, ['document_ids' => 'document_ids', 'name']);

            return ToolResult::success($this->service->mergeDocuments($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
