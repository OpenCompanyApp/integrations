<?php

namespace OpenCompany\Integrations\Weaviate\Tools;

use OpenCompany\Integrations\Weaviate\WeaviateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WeaviateCreateObject implements Tool
{
    /**
     * Create a new WeaviateCreateObject tool instance.
     */
    public function __construct(
        private WeaviateService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'weaviate_create_object';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new data object in a Weaviate class. Provide the class name and a properties object with the data fields. Optionally specify a UUID for the object.';
    }

    /**
     * Get the tool parameters definition.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'class' => ['type' => 'string', 'required' => true, 'description' => 'The class/collection name to create the object in (e.g., "Article", "Document").'],
            'properties' => ['type' => 'object', 'required' => true, 'description' => 'The object properties as key-value pairs. Keys must match the property names defined in the class schema.'],
            'id' => ['type' => 'string', 'required' => false, 'description' => 'Optional UUID for the object. If not provided, Weaviate will auto-generate one.'],
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

            $className = $args['class'] ?? '';
            $properties = $args['properties'] ?? [];
            $id = $args['id'] ?? null;

            if (empty($className)) {
                return ToolResult::error('class is required.');
            }

            if (empty($properties)) {
                return ToolResult::error('properties is required.');
            }

            $result = $this->service->createObject($className, $properties, $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
