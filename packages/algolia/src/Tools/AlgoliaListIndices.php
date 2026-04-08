<?php

namespace OpenCompany\Integrations\Algolia\Tools;

use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all indices in the Algolia application.
 */
class AlgoliaListIndices implements Tool
{
    public function __construct(
        private AlgoliaService $service,
    ) {}

    public function name(): string
    {
        return 'algolia_list_indices';
    }

    public function description(): string
    {
        return 'List all indices in the Algolia application. Returns index names, entry counts, and sizes information.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-based). Default: 0.'],
            'hitsPerPage' => ['type' => 'integer', 'description' => 'Number of indices per page. Default: 100.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Algolia integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['hitsPerPage'])) {
                $params['hitsPerPage'] = (int) $args['hitsPerPage'];
            }

            $result = $this->service->listIndices();

            $items = $result['items'] ?? [];

            $indices = array_map(function (array $item) {
                return [
                    'name' => $item['name'] ?? '',
                    'entries' => $item['entries'] ?? 0,
                    'dataSize' => $item['dataSize'] ?? 0,
                    'fileSize' => $item['fileSize'] ?? 0,
                    'createdAt' => $item['createdAt'] ?? null,
                    'updatedAt' => $item['updatedAt'] ?? null,
                    'primary' => $item['primary'] ?? null,
                    'replicas' => $item['replicas'] ?? null,
                ];
            }, $items);

            return ToolResult::success([
                'indices' => $indices,
                'nbPages' => $result['nbPages'] ?? 1,
                'indexCount' => count($indices),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
