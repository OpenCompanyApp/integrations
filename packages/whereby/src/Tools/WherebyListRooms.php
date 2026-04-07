<?php

namespace OpenCompany\Integrations\Whereby\Tools;

use OpenCompany\Integrations\Whereby\WherebyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WherebyListRooms implements Tool
{
    public function __construct(
        private WherebyService $service,
    ) {}

    public function name(): string
    {
        return 'whereby_list_rooms';
    }

    public function description(): string
    {
        return 'List Whereby rooms with optional pagination and filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of rooms to return.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor for fetching the next page of results.'],
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

            $result = $this->service->listRooms($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
