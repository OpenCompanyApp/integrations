<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get publication analytics and stats from Beehiiv.
 *
 * Supports different stat intents like overview, traffic, and growth metrics.
 */
class BeehiivGetStats implements Tool
{
    /**
     * Create a new BeehiivGetStats tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_get_stats';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get analytics and stats for your Beehiiv publication. Use the "intent" parameter to specify the type of stats (overview, traffic, growth, subscribers).';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'intent' => ['type' => 'string', 'description' => 'Type of stats to retrieve: "overview", "traffic", "growth", "subscribers". Default: "overview".'],
            'days' => ['type' => 'integer', 'description' => 'Number of days to look back (default: 30).'],
            'start_date' => ['type' => 'string', 'description' => 'Start date for custom range (ISO 8601, e.g., "2026-01-01").'],
            'end_date' => ['type' => 'string', 'description' => 'End date for custom range (ISO 8601, e.g., "2026-01-31").'],
        ];
    }

    /**
     * Execute the tool — get stats from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $params = [];

            if (isset($args['intent'])) {
                $params['intent'] = $args['intent'];
            }
            if (isset($args['days'])) {
                $params['days'] = (int) $args['days'];
            }
            if (isset($args['start_date'])) {
                $params['start_date'] = $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['end_date'] = $args['end_date'];
            }

            $result = $this->service->getStats($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
