<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeilisearchGetDocument implements Tool
{
    /**
     * Create a new MeilisearchGetDocument tool instance.
     */
    public function __construct(
        private MeilisearchService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'meilisearch_get_document';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Retrieve a single document from a Meilisearch index by its primary key value.';
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
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The document primary key value to retrieve.'],
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

            $docId = $args['doc_id'] ?? '';
            if (empty($docId)) {
                return ToolResult::error('The "doc_id" parameter is required.');
            }

            $result = $this->service->getDocument($indexUid, $docId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
