<?php

namespace OpenCompany\Integrations\Weaviate\Tools;

use OpenCompany\Integrations\Weaviate\WeaviateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WeaviateGetObject implements Tool
{
    /**
     * Create a new WeaviateGetObject tool instance.
     */
    public function __construct(
        private WeaviateService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'weaviate_get_object';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Retrieve a specific data object from Weaviate by its class name and UUID. Returns the full object including all properties and metadata.';
    }

    /**
     * Get the tool parameters definition.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'class_name' => ['type' => 'string', 'required' => true, 'description' => 'The class/collection name the object belongs to (e.g., "Article", "Document").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the object to retrieve.'],
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
            $id = $args['id'] ?? '';

            if (empty($className)) {
                return ToolResult::error('class_name is required.');
            }

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getObject($className, $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
