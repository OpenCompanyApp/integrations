<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioUpdateRecord implements Tool
{
    /**
     * Create a new AttioUpdateRecord tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_update_record';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'Update an existing record in Attio by its object type and record ID. Only the attributes provided in data will be updated.';
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
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Record data to update, keyed by attribute slug. Only provided fields will be changed.'],
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

            $result = $this->service->updateRecord($args['object'], $args['id'], $args['data']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
