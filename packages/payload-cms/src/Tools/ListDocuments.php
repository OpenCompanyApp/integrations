<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List documents in a collection with optional filtering and pagination.
 */
class ListDocuments implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_list_documents';
    }

    public function description(): string
    {
        return <<<'MD'
        List documents in a Payload CMS collection. Supports pagination (limit, page),
        sorting, and filtering via the where parameter.
        Returns document IDs, timestamps, and field values.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection slug to query.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of documents to return (default 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field. Prefix with "-" for descending. E.g. "createdAt" or "-updatedAt".'],
            'where' => ['type' => 'string', 'description' => 'JSON object for filtering. E.g. \'{"title":{"equals":"Hello"}}\'.'],
        ];
    }

    /**
     * List documents with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection, limit, page, sort, where)
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

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            if (isset($args['sort']) && ! empty($args['sort'])) {
                $params['sort'] = $args['sort'];
            }

            if (isset($args['where']) && ! empty($args['where'])) {
                $where = is_string($args['where']) ? json_decode($args['where'], true) : $args['where'];
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in where: ' . json_last_error_msg());
                }
                $params['where'] = $where;
            }

            $result = $this->service->listDocuments($collection, $params);
            $docs = $result['docs'] ?? $result;

            if (empty($docs)) {
                return ToolResult::success('No documents found.');
            }

            return ToolResult::success([
                'total' => $result['totalDocs'] ?? count($docs),
                'count' => count($docs),
                'page' => $result['page'] ?? 1,
                'totalPages' => $result['totalPages'] ?? 1,
                'items' => $docs,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
