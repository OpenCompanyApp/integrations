<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_list_events
 *
 * Lists events on the signed-in user's default calendar via the Microsoft Graph API.
 */
class OutlookListEvents implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_list_events';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List upcoming calendar events from the default Outlook calendar. Supports filtering by date range, subject, and more via OData query parameters.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'top' => [
                'type'        => 'integer',
                'description' => 'Maximum number of events to return (default: 25, max: 999).',
            ],
            'filter' => [
                'type'        => 'string',
                'description' => 'OData filter expression, e.g. "start/dateTime ge \'2025-01-01T00:00:00\'" or "isAllDay eq true".',
            ],
            'orderby' => [
                'type'        => 'string',
                'description' => 'OData orderby expression, e.g. "start/dateTime".',
            ],
            'select' => [
                'type'        => 'string',
                'description' => 'Comma-separated list of properties to include, e.g. "subject,start,end,location".',
            ],
            'start_date_time' => [
                'type'        => 'string',
                'description' => 'Start of the date range to list events for (ISO 8601, e.g. "2025-01-01T00:00:00"). Sets $filter automatically when provided.',
            ],
            'end_date_time' => [
                'type'        => 'string',
                'description' => 'End of the date range to list events for (ISO 8601, e.g. "2025-12-31T23:59:59"). Used with start_date_time.',
            ],
        ];
    }

    /**
     * Execute the tool: list calendar events.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            $params = [];

            if (isset($args['top'])) {
                $params['$top'] = (int) $args['top'];
            }
            if (isset($args['select'])) {
                $params['$select'] = $args['select'];
            }
            if (isset($args['orderby'])) {
                $params['$orderby'] = $args['orderby'];
            }

            // Build date-range filter from convenience parameters
            if (isset($args['start_date_time']) || isset($args['end_date_time'])) {
                $filterParts = [];

                if (isset($args['start_date_time'])) {
                    $filterParts[] = "start/dateTime ge '{$args['start_date_time']}'";
                }
                if (isset($args['end_date_time'])) {
                    $filterParts[] = "end/dateTime le '{$args['end_date_time']}'";
                }

                $dateFilter = implode(' and ', $filterParts);

                // Merge with any existing filter
                if (isset($args['filter'])) {
                    $params['$filter'] = "{$args['filter']} and {$dateFilter}";
                } else {
                    $params['$filter'] = $dateFilter;
                }
            } elseif (isset($args['filter'])) {
                $params['$filter'] = $args['filter'];
            }

            $result = $this->service->listEvents($params);

            $events = $result['value'] ?? [];
            $nextLink = $result['@odata.nextLink'] ?? null;

            $response = [
                'events' => $events,
                'count'  => count($events),
            ];

            if ($nextLink) {
                $response['hasMore'] = true;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
