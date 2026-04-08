<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Twilio usage records with optional filtering.
 *
 * Supports filtering by category, date range, and pagination.
 */
class TwilioListUsageRecords implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_list_usage_records';
    }

    public function description(): string
    {
        return <<<'MD'
        List Twilio usage records with optional filtering.
        Filter by category and date range. Returns usage counts and pricing per category.
        MD;
    }

    public function parameters(): array
    {
        return [
            'category' => ['type' => 'string', 'description' => 'Filter by usage category (e.g., "calls", "sms", "phonenumbers", "totalprice").'],
            'start_date' => ['type' => 'string', 'description' => 'Start date for usage records (YYYY-MM-DD format).'],
            'end_date' => ['type' => 'string', 'description' => 'End date for usage records (YYYY-MM-DD format).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of records to return.'],
        ];
    }

    /**
     * List Twilio usage records with optional filtering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (category, start_date, end_date, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $params = [];

            if (! empty($args['category'])) {
                $params['Category'] = $args['category'];
            }
            if (! empty($args['start_date'])) {
                $params['StartDate'] = $args['start_date'];
            }
            if (! empty($args['end_date'])) {
                $params['EndDate'] = $args['end_date'];
            }

            $result = $this->service->listUsageRecords($params);

            $records = $result['usage_records'] ?? $result['data'] ?? [];

            $records = array_map(function (array $r) {
                return [
                    'category' => $r['category'] ?? '',
                    'description' => $r['description'] ?? '',
                    'count' => $r['count'] ?? '0',
                    'count_unit' => $r['count_unit'] ?? '',
                    'usage' => $r['usage'] ?? '0',
                    'usage_unit' => $r['usage_unit'] ?? '',
                    'price' => $r['price'] ?? '0',
                    'price_unit' => $r['price_unit'] ?? '',
                    'start_date' => $r['start_date'] ?? null,
                    'end_date' => $r['end_date'] ?? null,
                ];
            }, $records);

            if (isset($args['limit']) && $args['limit'] > 0) {
                $records = array_slice($records, 0, (int) $args['limit']);
            }

            return ToolResult::success([
                'usage_records' => $records,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
