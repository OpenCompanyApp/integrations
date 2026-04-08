<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for sending batch update requests to a Google Docs document.
 *
 * Supports all Google Docs API batch update request types including
 * inserting text, updating text style, creating paragraphs, and more.
 */
class GdocsBatchUpdate implements Tool
{
    /**
     * Create a new GdocsBatchUpdate tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_batch_update';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Send batch update requests to a Google Docs document. Supports inserting text, updating text styles, creating paragraphs, and other document modifications. Each request in the array is a Google Docs API request object.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'documentId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the document to update.'],
            'requests' => ['type' => 'array', 'required' => true, 'description' => 'Array of Google Docs API request objects. Each request is an object with one key (e.g., insertText, updateTextStyle, createParagraphBullets). See Google Docs API reference for all request types.'],
        ];
    }

    /**
     * Execute the batch update request.
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
            $requests = $args['requests'];

            if (empty($requests) || !is_array($requests)) {
                return ToolResult::error('The requests array must contain at least one request object.');
            }

            $result = $this->service->batchUpdate($documentId, $requests);

            return ToolResult::success([
                'documentId' => $documentId,
                'replies' => $result['replies'] ?? [],
                'writeControl' => $result['writeControl'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
