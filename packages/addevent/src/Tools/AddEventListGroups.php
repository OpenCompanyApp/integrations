<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List event groups from AddEvent with optional pagination.
 *
 * Groups are collections of related events. Use limit and page parameters
 * to paginate through results.
 */
class AddEventListGroups implements Tool
{
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_groups';
    }

    public function description(): string
    {
        return 'List event groups from AddEvent. Groups are collections of related events. Supports pagination with limit and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of groups per page (default: 50, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listGroups($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
