<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single Google Docs document by its ID.
 *
 * Returns the full document resource including body content,
 * inline objects, and document styling information.
 */
class GdocsGetDocument implements Tool
{
    /**
     * Create a new GdocsGetDocument tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_get_document';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get the full content and structure of a Google Docs document by its ID. Returns the document title, body content (paragraphs, text runs), and styling information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'documentId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Google Docs document. Can be extracted from the document URL: https://docs.google.com/document/d/{documentId}/edit'],
        ];
    }

    /**
     * Execute the get document request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Docs integration is not configured.');
            }

            $documentId = $args['documentId'];
            $result = $this->service->getDocument($documentId);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the document response for easier consumption.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $body = $result['body'] ?? [];
        $content = $body['content'] ?? [];

        // Extract plain text from all paragraphs
        $textParts = [];
        foreach ($content as $structuralElement) {
            if (isset($structuralElement['paragraph'])) {
                $paragraph = $structuralElement['paragraph'];
                foreach ($paragraph['elements'] ?? [] as $element) {
                    if (isset($element['textRun']['content'])) {
                        $textParts[] = $element['textRun']['content'];
                    }
                }
            }
        }

        return [
            'documentId' => $result['documentId'] ?? null,
            'title' => $result['title'] ?? null,
            'revisionId' => $result['revisionId'] ?? null,
            'plainText' => implode('', $textParts),
            'raw' => $result,
        ];
    }
}
