<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all collections in the Pinecone project.
 *
 * Collections are static snapshots of an index that can be used to
 * back up data or create new indexes from an existing one.
 */
class PineconeListCollections implements Tool
{
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_list_collections';
    }

    public function description(): string
    {
        return 'List all collections in your Pinecone project. Collections are static snapshots of indexes used for backups or creating new indexes.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
