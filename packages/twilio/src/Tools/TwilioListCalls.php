<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Twilio calls with optional filtering.
 *
 * Supports filtering by To, From, Status, and pagination with PageSize.
 */
class TwilioListCalls implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_list_calls';
    }

    public function description(): string
    {
        return <<<'MD'
        List Twilio calls with optional filtering.
        Filter by To, From, Status. Use PageSize to control pagination (default 50, max 1000).
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'description' => 'Filter by destination phone number in E.164 format.'],
            'from' => ['type' => 'string', 'description' => 'Filter by originating phone number in E.164 format.'],
            'status' => ['type' => 'string', 'description' => 'Filter by call status (queued, ringing, in-progress, canceled, completed, failed, busy, no-answer).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of calls to return.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default 50, max 1000).'],
        ];
    }

    /**
     * List Twilio calls with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, status, limit, page_size)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $params = [];

            if (! empty($args['to'])) {
                $params['To'] = $args['to'];
            }
            if (! empty($args['from'])) {
                $params['From'] = $args['from'];
            }
            if (! empty($args['status'])) {
                $params['Status'] = $args['status'];
            }
            if (! empty($args['page_size'])) {
                $params['PageSize'] = (int) $args['page_size'];
            }

            $result = $this->service->listCalls($params);

            $calls = $result['calls'] ?? $result['data'] ?? [];

            $calls = array_map(function (array $c) {
                return [
                    'sid' => $c['sid'] ?? '',
                    'to' => $c['to'] ?? '',
                    'from' => $c['from'] ?? '',
                    'status' => $c['status'] ?? '',
                    'direction' => $c['direction'] ?? '',
                    'date_created' => $c['date_created'] ?? null,
                    'duration' => $c['duration'] ?? null,
                    'price' => $c['price'] ?? null,
                ];
            }, $calls);

            if (isset($args['limit']) && $args['limit'] > 0) {
                $calls = array_slice($calls, 0, (int) $args['limit']);
            }

            return ToolResult::success([
                'calls' => $calls,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
