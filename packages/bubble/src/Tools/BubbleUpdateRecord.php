<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing record in Bubble by its unique ID.
 *
 * Only the fields provided will be updated; other fields remain unchanged.
 */
class BubbleUpdateRecord implements Tool
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
        return 'bubble_update_record';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Update an existing record in Bubble by its data type and unique ID. Only the fields provided will be changed; other fields remain unchanged. Returns the updated record.';
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
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the record to update (Bubble-generated UUID).'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field names and values to update. Only the provided fields will be changed. Example: {"name": "Jane", "status": "active"}. Pass as a JSON string.'],
        ];
    }

    /**
     * Execute the update record tool.
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

            $result = $this->service->updateRecord($args['type'], $args['id'], $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
