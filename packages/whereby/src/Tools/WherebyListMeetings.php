<?php

namespace OpenCompany\Integrations\Whereby\Tools;

use OpenCompany\Integrations\Whereby\WherebyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WherebyListMeetings implements Tool
{
    public function __construct(
        private WherebyService $service,
    ) {}

    public function name(): string
    {
        return 'whereby_list_meetings';
    }

    public function description(): string
    {
        return 'List past Whereby meetings with optional pagination and date filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of meetings to return.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor for fetching the next page of results.'],
            'from_date' => ['type' => 'string', 'required' => false, 'description' => 'ISO 8601 start date to filter meetings from.'],
            'to_date' => ['type' => 'string', 'required' => false, 'description' => 'ISO 8601 end date to filter meetings to.'],
            'room_name' => ['type' => 'string', 'required' => false, 'description' => 'Filter meetings by room name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Whereby integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (!empty($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }
            if (!empty($args['from_date'])) {
                $params['fromDate'] = $args['from_date'];
            }
            if (!empty($args['to_date'])) {
                $params['toDate'] = $args['to_date'];
            }
            if (!empty($args['room_name'])) {
                $params['roomName'] = $args['room_name'];
            }

            $result = $this->service->listMeetings($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
