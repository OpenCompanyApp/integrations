<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Start a LINE loading animation.
 *
 * Displays the typing/loading animation in a one-on-one chat or supported chat target.
 */
class LineStartLoadingAnimation implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_start_loading_animation';
    }

    public function description(): string
    {
        return 'Display a LINE loading animation for a chat.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE chat ID.'],
            'loading_seconds' => ['type' => 'integer', 'description' => 'Optional loading duration in seconds.'],
        ];
    }

    /**
     * Start a loading animation.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->startLoadingAnimation(
                (string) ($args['chat_id'] ?? ''),
                isset($args['loading_seconds']) ? (int) $args['loading_seconds'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
