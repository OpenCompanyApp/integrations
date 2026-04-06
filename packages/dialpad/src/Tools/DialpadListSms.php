<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List SMS messages from Dialpad.
 *
 * Supports filtering by date range and cursor-based pagination.
 */
class DialpadListSms implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_list_sms';
    }

    public function description(): string
    {
        return 'List SMS messages from Dialpad. Returns message details including sender, recipient, text content, and timestamps. Supports date range filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'startTime' => ['type' => 'integer', 'description' => 'Unix timestamp for the start of the date range.'],
            'endTime' => ['type' => 'integer', 'description' => 'Unix timestamp for the end of the date range.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of SMS messages to return (default: 50).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
            }

            $result = $this->service->listSms(
                startTime: isset($args['startTime']) ? (int) $args['startTime'] : null,
                endTime: isset($args['endTime']) ? (int) $args['endTime'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : 50,
                cursor: $args['cursor'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
