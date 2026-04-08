<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseCreateCollection implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_create_collection';
    }

    public function description(): string
    {
        return 'Create a new collection in Typesense with a specified schema including field definitions and optional default sorting field.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new collection.'],
            'fields' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of field definitions. Each field should have "name", "type" (e.g., "string", "int32", "float", "bool"), and optionally "facet", "optional", "index".',
                'items' => ['type' => 'object'],
            ],
            'default_sorting_field' => ['type' => 'string', 'description' => 'The name of an int32 or float field to use for default sorting.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typesense integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $fields = $args['fields'] ?? [];
            if (empty($fields)) {
                return ToolResult::error('The "fields" parameter is required and must be a non-empty array.');
            }

            $schema = [
                'name' => $name,
                'fields' => $fields,
            ];

            if (isset($args['default_sorting_field']) && !empty($args['default_sorting_field'])) {
                $schema['default_sorting_field'] = $args['default_sorting_field'];
            }

            $result = $this->service->createCollection($schema);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
