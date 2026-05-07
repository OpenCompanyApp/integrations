<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\Integrations\Bubble\BubbleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a record from Bubble by its unique ID.
 */
class BubbleDeleteRecord implements Tool
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
        return 'bubble_delete_record';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a record from Bubble by its data type and unique ID. This action is permanent and cannot be undone.';
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
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the record to delete (Bubble-generated UUID).'],
        ];
    }

    /**
     * Execute the delete record tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            return ToolResult::success($this->service->deleteRecord($args['type'], $args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
