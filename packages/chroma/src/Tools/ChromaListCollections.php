<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Chroma collections in the configured tenant/database.
 */
class ChromaListCollections implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_list_collections';
    }

    public function description(): string
    {
        return 'List all vector collections in Chroma. Returns collection names and IDs that can be used for further operations.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of collections to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the collection list request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : null;
            $result = $this->service->listCollections($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
