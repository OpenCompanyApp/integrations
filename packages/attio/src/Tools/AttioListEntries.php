<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioListEntries implements Tool
{
    /**
     * Create a new AttioListEntries tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_list_entries';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'List entries (records) in a specific Attio list. Supports pagination with limit and offset. Each entry contains the record data as displayed in that list view.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The list UUID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of entries to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of entries to skip for pagination (default: 0).'],
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

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listEntries($args['id'], $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
