<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a JQL query against Mixpanel data.
 *
 * JQL (JavaScript Query Language) allows complex custom queries
 * using JavaScript to transform and filter Mixpanel event and
 * people data.
 */
class MixpanelQueryJql implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_query_jql';
    }

    public function description(): string
    {
        return 'Execute a JQL (JavaScript Query Language) script against Mixpanel data.';
    }

    public function parameters(): array
    {
        return [
            'script' => ['type' => 'string', 'required' => true, 'description' => 'JQL script to execute (e.g., "Events({from_date: \'2024-01-01\', to_date: \'2024-01-31\'}).filter(e => e.name === \'Signup\')").'],
            'params' => ['type' => 'string', 'description' => 'JSON object of parameters to pass into the JQL script (accessible via params object).'],
        ];
    }

    /**
     * Execute a JQL script against Mixpanel data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (script, params)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $script = $args['script'] ?? '';

            if (empty($script)) {
                return ToolResult::error('script is required.');
            }

            $params = $args['params'] ?? [];
            if (is_string($params)) {
                $params = json_decode($params, true) ?? [];
            }

            $result = $this->service->queryJql($script, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
