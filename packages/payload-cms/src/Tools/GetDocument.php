<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single document by ID from a collection.
 */
class GetDocument implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_get_document';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific document by its ID within a collection.
        Returns all field values, timestamps, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection slug the document belongs to.'],
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the document to retrieve.'],
        ];
    }

    /**
     * Get a document by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection, document_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $collection = $args['collection'] ?? '';
            $documentId = $args['document_id'] ?? '';

            if (empty($collection)) {
                return ToolResult::error('collection is required.');
            }

            if (empty($documentId)) {
                return ToolResult::error('document_id is required.');
            }

            $result = $this->service->getDocument($collection, $documentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
