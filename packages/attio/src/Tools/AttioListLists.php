<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioListLists implements Tool
{
    /**
     * Create a new AttioListLists tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_list_lists';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'List all lists in the Attio workspace. Lists are filtered views of objects (e.g. "High Priority Deals", "New Leads").';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Attio integration is not configured.');
            }

            $result = $this->service->listLists();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
