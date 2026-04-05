<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list team members in the Workable account.
 *
 * Returns a paginated list of members including names, emails,
 * and roles within the Workable account.
 */
class WorkableListMembers implements Tool
{
    /**
     * Create a new WorkableListMembers tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_list_members';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List team members in your Workable account. Returns member names, emails, and roles.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of members to return (default: 50).'],
        ];
    }

    /**
     * Execute the list members request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;

            $result = $this->service->listMembers($limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
