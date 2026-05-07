<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * View OneSignal outcome analytics.
 */
class OneSignalViewOutcomes extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_view_outcomes';
    }

    public function description(): string
    {
        return 'View outcome analytics such as clicks, confirmed deliveries, session duration, or custom outcomes.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'outcome_names' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated outcome names such as os__click.count.'],
            'outcome_time_range' => ['type' => 'string', 'enum' => ['1h', '1d', '1mo'], 'description' => 'Time range.'],
            'outcome_platforms' => ['type' => 'string', 'description' => 'Comma-separated platform IDs.'],
            'outcome_attribution' => ['type' => 'string', 'enum' => ['direct', 'influenced', 'unattributed', 'total'], 'description' => 'Attribution type.'],
        ];
    }

    /**
     * Execute outcome query.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->viewOutcomes(
            $args['app_id'] ?? null,
            $this->only($args, ['outcome_names', 'outcome_time_range', 'outcome_platforms', 'outcome_attribution']),
        ));
    }
}
