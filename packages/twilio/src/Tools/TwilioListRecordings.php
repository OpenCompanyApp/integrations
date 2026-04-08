<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Twilio call recordings with optional filtering.
 *
 * Supports filtering by call SID, date created, and pagination.
 */
class TwilioListRecordings implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_list_recordings';
    }

    public function description(): string
    {
        return <<<'MD'
        List Twilio call recordings with optional filtering.
        Filter by call SID, date created, or limit the number of results returned.
        MD;
    }

    public function parameters(): array
    {
        return [
            'call_sid' => ['type' => 'string', 'description' => 'Filter by call SID to get recordings for a specific call.'],
            'date_created' => ['type' => 'string', 'description' => 'Filter by date created (YYYY-MM-DD format).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of recordings to return.'],
        ];
    }

    /**
     * List Twilio call recordings with optional filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (call_sid, date_created, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $params = [];

            if (! empty($args['call_sid'])) {
                $params['CallSid'] = $args['call_sid'];
            }
            if (! empty($args['date_created'])) {
                $params['DateCreated'] = $args['date_created'];
            }
            if (! empty($args['limit'])) {
                $params['PageSize'] = (int) $args['limit'];
            }

            $result = $this->service->listRecordings($params);

            $recordings = $result['recordings'] ?? $result['data'] ?? [];

            $recordings = array_map(function (array $r) {
                return [
                    'sid' => $r['sid'] ?? '',
                    'call_sid' => $r['call_sid'] ?? '',
                    'duration' => $r['duration'] ?? '',
                    'status' => $r['status'] ?? '',
                    'date_created' => $r['date_created'] ?? null,
                    'price' => $r['price'] ?? null,
                    'price_unit' => $r['price_unit'] ?? null,
                    'uri' => $r['uri'] ?? null,
                ];
            }, $recordings);

            return ToolResult::success([
                'recordings' => $recordings,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
