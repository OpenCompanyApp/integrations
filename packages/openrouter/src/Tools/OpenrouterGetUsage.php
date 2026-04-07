<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get usage statistics for the OpenRouter account.
 *
 * Sends a GET request to /usage with optional query parameters
 * for filtering by time period. Returns usage and cost data.
 *
 * @see https://openrouter.ai/docs/api-reference/get-usage
 */
class OpenrouterGetUsage implements Tool
{
    /**
     * @param  OpenrouterService  $service  The OpenRouter service instance.
     */
    public function __construct(
        private OpenrouterService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'openrouter_get_usage';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get usage statistics for the OpenRouter account, including token counts and costs.';
    }

    /**
     * Parameter schema for the get usage request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'period' => ['type' => 'string', 'description' => 'Time period for usage data (e.g., "day", "week", "month").'],
        ];
    }

    /**
     * Execute the get usage request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The usage data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            $params = [];

            if (isset($args['period'])) {
                $params['period'] = $args['period'];
            }

            $result = $this->service->getUsage($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
