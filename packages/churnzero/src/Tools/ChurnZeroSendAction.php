<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Send an advanced raw ChurnZero action.
 *
 * This escape hatch keeps newer action parameters usable without exposing the
 * appKey secret to the agent.
 */
class ChurnZeroSendAction implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_send_action';
    }

    public function description(): string
    {
        return 'Send an advanced raw ChurnZero HTTP API action. Do not include appKey; the integration adds credentials automatically.';
    }

    public function parameters(): array
    {
        return [
            'params' => [
                'type' => 'object',
                'required' => true,
                'description' => 'ChurnZero action query parameters excluding appKey, for example action, accountExternalId, and eventName.',
            ],
        ];
    }

    /**
     * Send a raw ChurnZero action.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $params = $args['params'] ?? [];
            if (! is_array($params) || $params === []) {
                return ToolResult::error('params must be a non-empty object.');
            }
            if (array_key_exists('appKey', $params) || array_key_exists('app_key', $params)) {
                return ToolResult::error('Do not pass appKey to this tool; credentials are added automatically.');
            }

            return ToolResult::success($this->service->sendAction($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
