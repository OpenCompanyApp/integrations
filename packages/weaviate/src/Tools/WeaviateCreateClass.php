<?php

namespace OpenCompany\Integrations\Weaviate\Tools;

use OpenCompany\Integrations\Weaviate\WeaviateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WeaviateCreateClass implements Tool
{
    /**
     * Create a new WeaviateCreateClass tool instance.
     */
    public function __construct(
        private WeaviateService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'weaviate_create_class';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new class (collection) in the Weaviate schema. Provide a class definition with the class name and an array of property definitions (name, dataType, etc.).';
    }

    /**
     * Get the tool parameters definition.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'class' => ['type' => 'object', 'required' => true, 'description' => 'The class definition object. Must include "class" (string name) and "properties" (array of property definitions). Each property needs "name" (string) and "dataType" (array of strings, e.g., ["text"]).'],
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

            $classDefinition = $args['class'] ?? [];

            if (empty($classDefinition)) {
                return ToolResult::error('class definition is required.');
            }

            if (empty($classDefinition['class'])) {
                return ToolResult::error('The class definition must include a "class" name.');
            }

            $result = $this->service->createClass($classDefinition);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
