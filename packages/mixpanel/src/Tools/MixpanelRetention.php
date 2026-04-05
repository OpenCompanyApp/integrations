<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get retention data from Mixpanel.
 *
 * Retrieves retention (cohort analysis) data showing how many users
 * return after performing a specified "born" event.
 */
class MixpanelRetention implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_retention';
    }

    public function description(): string
    {
        return 'Get retention data for a cohort of users over time.';
    }

    public function parameters(): array
    {
        return [
            'from_date'      => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
            'to_date'        => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
            'retention_type' => ['type' => 'string', 'description' => 'Retention type: "birth" or "compounded". Defaults to "birth".'],
            'born_event'     => ['type' => 'string', 'description' => 'Event that defines cohort entry (e.g., "Signup").'],
            'born_where'     => ['type' => 'string', 'description' => 'Optional filter expression for the born event (e.g., \'properties["Source"] == "organic"\').'],
        ];
    }

    /**
     * Get retention (cohort) data from Mixpanel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_date, to_date, retention_type, born_event, born_where)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $fromDate = $args['from_date'] ?? '';
            $toDate = $args['to_date'] ?? '';

            if (empty($fromDate)) {
                return ToolResult::error('from_date is required.');
            }
            if (empty($toDate)) {
                return ToolResult::error('to_date is required.');
            }

            $retentionType = $args['retention_type'] ?? 'birth';
            $bornEvent = $args['born_event'] ?? '';
            $bornWhere = $args['born_where'] ?? '';

            $result = $this->service->retention($fromDate, $toDate, $retentionType, $bornEvent, $bornWhere);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
