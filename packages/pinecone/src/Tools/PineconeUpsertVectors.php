<?php

namespace OpenCompany\Integrations\Pinecone\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pinecone\PineconeService;

/**
 * Upsert vectors into a Pinecone index.
 *
 * Accepts an index host and a list of vector records with ids, values, and
 * optional metadata.
 */
class PineconeUpsertVectors implements Tool
{
    /**
     * @param  PineconeService  $service  The Pinecone API client.
     */
    public function __construct(
        private PineconeService $service,
    ) {}

    public function name(): string
    {
        return 'pinecone_upsert_vectors';
    }

    public function description(): string
    {
        return 'Upsert vectors into a Pinecone index using an index host URL.';
    }

    public function parameters(): array
    {
        return [
            'index_host' => ['type' => 'string', 'required' => true, 'description' => 'The index host URL, such as "https://example.svc.us-east-1.pinecone.io".'],
            'vectors' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Vector records with id, values, and optional metadata.',
                'items' => ['type' => 'object'],
            ],
        ];
    }

    /**
     * Upsert vectors into an index.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinecone integration is not configured.');
            }
            if (empty($args['index_host'])) {
                return ToolResult::error('Index host is required.');
            }
            if (empty($args['vectors']) || !is_array($args['vectors'])) {
                return ToolResult::error('Vectors array is required.');
            }

            return ToolResult::success($this->service->upsertVectors(
                (string) $args['index_host'],
                $args['vectors'],
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
