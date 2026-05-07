<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List scheduled Webex meetings.
 */
class WebexListMeetings extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_meetings';
    }

    public function description(): string
    {
        return 'List scheduled Webex meetings for the authenticated user. Supports date range filtering with "from" and "to" parameters (ISO 8601). Returns meeting titles, start/end times, and join links.';
    }

    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'description' => 'Start of the date range (ISO 8601, e.g., "2025-04-01T00:00:00Z"). Lists meetings starting from this time.'],
            'to' => ['type' => 'string', 'description' => 'End of the date range (ISO 8601, e.g., "2025-04-30T23:59:59Z"). Lists meetings up to this time.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum number of meetings to return (1-100, default: 100).'],
        ];
    }

    /**
     * List meetings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $max = isset($args['max']) ? (int) $args['max'] : 100;
            $result = $this->service->listMeetings(
                $args['from'] ?? null,
                $args['to'] ?? null,
                $max,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
