<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Download a SignNow document.
 */
class SignNowDownloadDocument extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_download_document';
    }

    public function description(): string
    {
        return 'Download a SignNow document and return the response body when the API returns binary or text content.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'type' => ['type' => 'string', 'description' => 'Optional download type accepted by SignNow.'],
        ];
    }

    /**
     * Download a document.
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

            $type = isset($args['type']) && is_scalar($args['type']) ? (string) $args['type'] : null;

            return ToolResult::success($this->service->downloadDocument((string) $args['document_id'], $type));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
