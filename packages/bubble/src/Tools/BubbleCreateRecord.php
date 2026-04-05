<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new record in a Bubble data type.
 */
class BubbleCreateRecord implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service instance.
     */
    public function __construct(
        private BubbleService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'bubble_create_record';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new record in a Bubble data type. Provide field names and values as a JSON object. Returns the created record including its generated ID.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'The Bubble data type name (case-sensitive, e.g. "User", "Product", "Order").'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field names and values for the new record. Example: {"name": "John", "email": "john@example.com", "age": 30}. Pass as a JSON string.'],
        ];
    }

    /**
     * Execute the create record tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            $fields = $args['fields'] ?? [];
            if (is_string($fields)) {
                $fields = json_decode($fields, true);
            }

            if (!is_array($fields)) {
                return ToolResult::error('The "fields" parameter must be a valid JSON object.');
            }

            $result = $this->service->createRecord($args['type'], $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
