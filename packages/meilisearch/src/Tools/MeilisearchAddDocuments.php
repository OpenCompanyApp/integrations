<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchAddDocuments implements Tool
{
    /**
     * Create a new MeilisearchAddDocuments tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_add_documents';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Add or replace documents in a Meilisearch index. Sends an array of document objects to be indexed. Returns a task object to track progress.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index_uid' => ['type' => 'string', 'required' => true, 'description' => 'The index unique identifier (e.g., "movies").'],
            'documents' => ['type' => 'array', 'required' => true, 'description' => 'An array of document objects to add. Each document must contain the primary key field.'],
            'primary_key' => ['type' => 'string', 'description' => 'The primary key field name (e.g., "id"). Only needed if not already set on the index.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Meilisearch integration is not configured.');
            }

            $indexUid = $args['index_uid'] ?? '';
            if (empty($indexUid)) {
                return ToolResult::error('The "index_uid" parameter is required.');
            }

            $documents = $args['documents'] ?? [];
            if (empty($documents) || !is_array($documents)) {
                return ToolResult::error('The "documents" parameter is required and must be a non-empty array.');
            }

            $primaryKey = $args['primary_key'] ?? null;
            $result = $this->service->addDocuments($indexUid, $documents, $primaryKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
