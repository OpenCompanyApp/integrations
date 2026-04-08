<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List time timers for the authenticated user in Teamwork.
 */
class TeamworkListTimers implements Tool
{
    /**
     * @param  TeamworkService  $service  The Teamwork API client
     */
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_list_timers';
    }

    public function description(): string
    {
        return 'List time timers for the authenticated user in Teamwork.';
    }

    public function parameters(): array
    {
        return [
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of timers per page.'],
        ];
    }

    /**
     * Retrieve a list of timers.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, pageSize)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }

            $timers = $this->service->listTimers($params);

            return ToolResult::success($timers);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
