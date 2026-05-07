<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a SignNow document.
 */
class SignNowUpdateDocument extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_update_document';
    }

    public function description(): string
    {
        return 'Update a SignNow document with official document fields such as fields, texts, checks, or document metadata.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Official document update payload.'],
        ];
    }

    /**
     * Update a document.
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
            if (!is_array($args['payload'] ?? null) || $args['payload'] === []) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->updateDocument((string) $args['document_id'], $args['payload']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
