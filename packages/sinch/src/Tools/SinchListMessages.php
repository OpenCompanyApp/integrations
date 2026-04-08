<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sinch\SinchService;

/**
 * List inbound and outbound SMS messages from Sinch.
 *
 * Supports filtering by direction, recipient, sender, date range,
 * and page-based pagination.
 */
class SinchListMessages implements Tool
{
    /**
     * @param  SinchService  $service  The Sinch API client
     */
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_list_messages';
    }

    public function description(): string
    {
        return 'List inbound and outbound SMS messages from Sinch. Supports filtering by direction, recipient, sender, and date range.';
    }

    public function parameters(): array
    {
        return [
            'direction' => [
                'type' => 'string',
                'description' => 'Filter by direction: "mt" (mobile terminated / outbound) or "mo" (mobile originated / inbound).',
            ],
            'to' => [
                'type' => 'string',
                'description' => 'Filter by destination phone number (E.164 format).',
            ],
            'from' => [
                'type' => 'string',
                'description' => 'Filter by originating phone number or sender (E.164 format).',
            ],
            'start_date' => [
                'type' => 'string',
                'description' => 'Start date for filtering (ISO 8601 format, e.g. 2024-01-01T00:00:00Z).',
            ],
            'end_date' => [
                'type' => 'string',
                'description' => 'End date for filtering (ISO 8601 format, e.g. 2024-12-31T23:59:59Z).',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default 0).',
            ],
            'page_size' => [
                'type' => 'integer',
                'description' => 'Number of results per page (default 30, max 100).',
            ],
        ];
    }

    /**
     * List messages from Sinch.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $params = [];

            if (isset($args['direction'])) {
                $params['direction'] = $args['direction'];
            }
            if (isset($args['to'])) {
                $params['to'] = $args['to'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }
            if (isset($args['start_date'])) {
                $params['start'] = $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['end'] = $args['end_date'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
