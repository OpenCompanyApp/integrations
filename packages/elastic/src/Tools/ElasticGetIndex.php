<?php

namespace OpenCompany\Integrations\Elastic\Tools;

use OpenCompany\Integrations\Elastic\ElasticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticGetIndex implements Tool
{
    /**
     * @param  ElasticService  $service  The Elasticsearch service instance
     */
    public function __construct(
        private ElasticService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'elastic_get_index';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Elasticsearch index, including mappings, settings, and aliases.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index' => ['type' => 'string', 'required' => true, 'description' => 'The name of the index to retrieve.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Elasticsearch integration is not configured.');
            }

            $index = $args['index'] ?? '';
            if (empty($index)) {
                return ToolResult::error('The "index" parameter is required.');
            }

            $result = $this->service->getIndex($index);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
