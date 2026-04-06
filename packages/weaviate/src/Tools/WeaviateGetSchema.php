<?php

namespace OpenCompany\Integrations\Weaviate\Tools;

use OpenCompany\Integrations\Weaviate\WeaviateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WeaviateGetSchema implements Tool
{
    /**
     * Create a new WeaviateGetSchema tool instance.
     */
    public function __construct(
        private WeaviateService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'weaviate_get_schema';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the schema definition for a specific class (collection) in Weaviate. Returns the class name, properties, vectorizer config, and module settings.';
    }

    /**
     * Get the tool parameters definition.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'class_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the class/collection to retrieve the schema for (e.g., "Article", "Document").'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weaviate integration is not configured.');
            }

            $className = $args['class_name'] ?? '';

            if (empty($className)) {
                return ToolResult::error('class_name is required.');
            }

            $result = $this->service->getSchema($className);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
