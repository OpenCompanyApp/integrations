<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all models in the Builder.io space.
 */
class BuilderIoListModels implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_list_models';
    }

    public function description(): string
    {
        return <<<'MD'
        List all models in the Builder.io space. Optionally control pagination with limit and offset.
        Returns model IDs, names, kinds, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of models to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of models to skip for pagination.'],
        ];
    }

    /**
     * List models with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listModels($params);
            $items = $result['results'] ?? $result;

            if (empty($items)) {
                return ToolResult::success('No models found.');
            }

            $output = [];
            foreach ($items as $item) {
                $output[] = [
                    'id' => $item['id'] ?? '',
                    'name' => $item['name'] ?? '',
                    'kind' => $item['kind'] ?? null,
                    'created_at' => $item['createdDate'] ?? $item['created_at'] ?? null,
                    'updated_at' => $item['lastUpdatedDate'] ?? $item['updated_at'] ?? null,
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
