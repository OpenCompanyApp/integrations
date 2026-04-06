<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_list_calendars
 *
 * Lists the signed-in user's calendars via the Microsoft Graph API.
 */
class OutlookListCalendars implements Tool
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
        return 'outlook_list_calendars';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all calendars in the signed-in user\'s Outlook mailbox. Returns calendar names, ids, and default calendar indicator.';
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
                'description' => 'Maximum number of calendars to return (default: 25).',
            ],
            'select' => [
                'type'        => 'string',
                'description' => 'Comma-separated list of properties to include, e.g. "id,name,isDefaultCalendar".',
            ],
        ];
    }

    /**
     * Execute the tool: list calendars.
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

            $result = $this->service->listCalendars($params);

            $calendars = $result['value'] ?? [];

            return ToolResult::success([
                'calendars' => $calendars,
                'count'     => count($calendars),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
