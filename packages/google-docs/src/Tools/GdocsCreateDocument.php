<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new Google Docs document.
 *
 * Creates a blank document with the specified title and returns
 * the document ID and edit URL.
 */
class GdocsCreateDocument implements Tool
{
    /**
     * Create a new GdocsCreateDocument tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_create_document';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Create a new Google Docs document with a given title. Returns the document ID and a link to edit the document in the browser.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title for the new document.'],
        ];
    }

    /**
     * Execute the create document request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Docs integration is not configured.');
            }

            $title = $args['title'];
            $result = $this->service->createDocument($title);

            $documentId = $result['documentId'] ?? null;

            return ToolResult::success([
                'documentId' => $documentId,
                'title' => $result['title'] ?? $title,
                'revisionId' => $result['revisionId'] ?? null,
                'editUrl' => $documentId ? "https://docs.google.com/document/d/{$documentId}/edit" : null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
