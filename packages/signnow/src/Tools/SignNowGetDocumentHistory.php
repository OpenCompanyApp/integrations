<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get SignNow document event history.
 */
class SignNowGetDocumentHistory extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_get_document_history';
    }

    public function description(): string
    {
        return 'Get event history for a SignNow document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
        ];
    }

    /**
     * Fetch document history.
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

            return ToolResult::success($this->service->getDocumentHistory((string) $args['document_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
