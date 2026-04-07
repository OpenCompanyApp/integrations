<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new document in a Payload CMS collection.
 */
class CreateDocument implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_create_document';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new document in a Payload CMS collection. Provide the collection slug
        and a JSON object of field values. The document is created as a draft by default
        (if versions are enabled on the collection).
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection slug to create the document in.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field values. E.g. \'{"title":"Hello","content":"World"}\'.'],
        ];
    }

    /**
     * Create a document with field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $collection = $args['collection'] ?? '';

            if (empty($collection)) {
                return ToolResult::error('collection is required.');
            }

            $dataRaw = $args['data'] ?? '';
            if (empty($dataRaw)) {
                return ToolResult::error('data is required.');
            }

            $data = is_string($dataRaw) ? json_decode($dataRaw, true) : $dataRaw;
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ToolResult::error('Invalid JSON in data: ' . json_last_error_msg());
            }

            $result = $this->service->createDocument($collection, $data);

            return ToolResult::success([
                'id' => $result['doc']['id'] ?? $result['id'] ?? '',
                'collection' => $collection,
                'created_at' => $result['doc']['createdAt'] ?? $result['createdAt'] ?? null,
                'data' => $result['doc'] ?? $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
