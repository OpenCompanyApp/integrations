<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a SignNow document download link.
 */
class SignNowGetDocumentDownloadLink extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_get_document_download_link';
    }

    public function description(): string
    {
        return 'Get a temporary download link for a SignNow document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'type' => ['type' => 'string', 'description' => 'Optional download type accepted by SignNow.'],
        ];
    }

    /**
     * Get a document download link.
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

            return ToolResult::success($this->service->getDocumentDownloadLink((string) $args['document_id'], $type));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
