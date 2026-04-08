<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Download a document from a DocuSign envelope.
 *
 * Returns the raw document bytes (typically a PDF). The response includes
 * base64-encoded content for transport through the tool layer.
 */
class DocuSignGetDocument implements Tool
{
    /**
     * Create a new DocuSignGetDocument tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_get_document';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Download a document from a DocuSign envelope. Returns the document content as base64-encoded data. Use "combined" as the document_id to download all documents as a single combined PDF.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'envelope_id' => ['type' => 'string', 'required' => true, 'description' => 'The envelope ID containing the document.'],
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'The document ID to download. Use "combined" to get all documents as a single PDF.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DocuSign integration is not configured.');
            }

            $content = $this->service->getDocument($args['envelope_id'], $args['document_id']);

            return ToolResult::success([
                'envelope_id' => $args['envelope_id'],
                'document_id' => $args['document_id'],
                'content_base64' => base64_encode($content),
                'size_bytes' => strlen($content),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
