<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioDeleteRecord implements Tool
{
    /**
     * Create a new AttioDeleteRecord tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_delete_record';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'Delete a record from Attio by its object type and record ID. This action is permanent and cannot be undone.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'object' => ['type' => 'string', 'required' => true, 'description' => 'The object slug (e.g. "people", "companies", "deals").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The record UUID.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Attio integration is not configured.');
            }

            $this->service->deleteRecord($args['object'], $args['id']);

            return ToolResult::success("Record {$args['id']} has been deleted from '{$args['object']}'.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
