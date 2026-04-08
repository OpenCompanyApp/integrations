<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list goals from Fellow.
 */
class FellowListGoals implements Tool
{
    /**
     * Create a new FellowListGoals tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_list_goals';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List goals from Fellow. Returns goal titles, descriptions, progress, assignees, and due dates.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of goals to return per page (default: 25).'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
            }

            $params = [];

            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listGoals($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
