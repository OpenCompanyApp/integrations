<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioCreateRecord implements Tool
{
    /**
     * Create a new AttioCreateRecord tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_create_record';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'Create a new record in Attio for a given object type. Pass attribute values keyed by their attribute slug in the data parameter.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'object_id' => ['type' => 'string', 'required' => true, 'description' => 'The object slug or ID (e.g. "people", "companies", "deals").'],
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Record data keyed by attribute slug. Example: {"name": "Acme Corp", "website": "https://acme.com"}. Values depend on the attribute type.'],
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

            $result = $this->service->createRecord($args['object_id'], $args['data']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
