<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Retrieve SMS message history from ClickSend.
 *
 * Supports date range filtering and page-based pagination.
 */
class ClickSendGetSmsHistory implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_get_sms_history';
    }

    public function description(): string
    {
        return 'Get SMS message history from ClickSend. Supports date range filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'date_from' => [
                'type' => 'string',
                'description' => 'Start date for history (YYYY-MM-DD or Unix timestamp).',
            ],
            'date_to' => [
                'type' => 'string',
                'description' => 'End date for history (YYYY-MM-DD or Unix timestamp).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of records per page (default 15).',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default 1).',
            ],
        ];
    }

    /**
     * Get SMS history from ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments (date_from, date_to, limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $params = [];

            if (isset($args['date_from'])) {
                $params['date_from'] = $args['date_from'];
            }
            if (isset($args['date_to'])) {
                $params['date_to'] = $args['date_to'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->getSmsHistory($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
