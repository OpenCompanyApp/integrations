<?php

namespace OpenCompany\Integrations\Elastic\Tools;

use OpenCompany\Integrations\Elastic\ElasticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticCreateIndex implements Tool
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
        return 'elastic_create_index';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new Elasticsearch index with optional settings and mappings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new index.'],
            'settings' => ['type' => 'object', 'description' => 'Optional index settings and mappings. Example: {"settings": {"number_of_shards": 1}, "mappings": {"properties": {"title": {"type": "text"}}}}'],
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

            $settings = $args['settings'] ?? null;
            if (is_string($settings)) {
                $settings = json_decode($settings, true);
            }

            $result = $this->service->createIndex($index, $settings);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
