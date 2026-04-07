<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List content entries for a model in Builder.io.
 */
class BuilderIoListContent implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_list_content';
    }

    public function description(): string
    {
        return <<<'MD'
        List content entries for a specific Builder.io model. Optionally control pagination
        with limit and offset, or filter with a query string.
        Returns entry IDs, names, and data.
        MD;
    }

    public function parameters(): array
    {
        return [
            'model_name' => ['type' => 'string', 'required' => true, 'description' => 'The model name to list content for (e.g. "page", "blog-post").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of entries to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of entries to skip for pagination.'],
            'query' => ['type' => 'string', 'description' => 'Query string to filter content entries.'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of fields to include in the response.'],
        ];
    }

    /**
     * List content entries for a model.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model_name, limit, offset, query, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $modelName = $args['model_name'] ?? '';

            if (empty($modelName)) {
                return ToolResult::error('model_name is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            if (isset($args['query']) && ! empty($args['query'])) {
                $params['query'] = $args['query'];
            }

            if (isset($args['fields']) && ! empty($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->listContent($modelName, $params);
            $items = $result['results'] ?? $result;

            if (empty($items)) {
                return ToolResult::success('No content entries found.');
            }

            $output = [];
            foreach ($items as $item) {
                $output[] = [
                    'id' => $item['id'] ?? '',
                    'name' => $item['name'] ?? '',
                    'model' => $item['modelId'] ?? $item['model'] ?? null,
                    'created_at' => $item['createdDate'] ?? $item['created_at'] ?? null,
                    'updated_at' => $item['lastUpdatedDate'] ?? $item['updated_at'] ?? null,
                    'data' => $item['data'] ?? [],
                ];
            }

            return ToolResult::success([
                'count' => count($output),
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
