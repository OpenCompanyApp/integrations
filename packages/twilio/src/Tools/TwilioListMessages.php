<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Twilio messages with optional filtering.
 *
 * Supports filtering by To, From, DateSent, and pagination with PageSize.
 */
class TwilioListMessages implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_list_messages';
    }

    public function description(): string
    {
        return <<<'MD'
        List Twilio messages with optional filtering.
        Filter by To, From, DateSent. Use PageSize to control pagination (default 50, max 1000).
        MD;
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'description' => 'Filter by destination phone number in E.164 format.'],
            'from' => ['type' => 'string', 'description' => 'Filter by originating phone number in E.164 format.'],
            'date_sent' => ['type' => 'string', 'description' => 'Filter by date sent (YYYY-MM-DD format).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default 50, max 1000).'],
        ];
    }

    /**
     * List Twilio messages with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, date_sent, limit, page_size)
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
            if (! empty($args['date_sent'])) {
                $params['DateSent'] = $args['date_sent'];
            }
            if (! empty($args['page_size'])) {
                $params['PageSize'] = (int) $args['page_size'];
            }

            $result = $this->service->listMessages($params);

            $messages = $result['messages'] ?? $result['data'] ?? [];

            $messages = array_map(function (array $m) {
                return [
                    'sid' => $m['sid'] ?? '',
                    'to' => $m['to'] ?? '',
                    'from' => $m['from'] ?? '',
                    'body' => $m['body'] ?? '',
                    'status' => $m['status'] ?? '',
                    'direction' => $m['direction'] ?? '',
                    'date_created' => $m['date_created'] ?? null,
                    'date_sent' => $m['date_sent'] ?? null,
                ];
            }, $messages);

            if (isset($args['limit']) && $args['limit'] > 0) {
                $messages = array_slice($messages, 0, (int) $args['limit']);
            }

            return ToolResult::success([
                'messages' => $messages,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
