<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Chroma\ChromaService;

/**
 * Count Chroma collections in the configured tenant/database.
 */
class ChromaCountCollections implements Tool
{
    /**
     * @param  ChromaService  $service  Chroma API client.
     */
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_count_collections';
    }

    public function description(): string
    {
        return 'Count vector collections in the configured Chroma tenant/database.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the collection count request.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are used.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            return ToolResult::success($this->service->countCollections());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
