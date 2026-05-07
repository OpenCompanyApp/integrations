<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Send a Pushbullet ephemeral event.
 *
 * Ephemerals are used for clipboard, dismissal, and other realtime events.
 */
class PushbulletPushEphemeral implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_push_ephemeral'; }

    public function description(): string { return 'Send a Pushbullet ephemeral event such as a clip or notification dismissal.'; }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Outer ephemeral type, usually "push".'],
            'push' => ['type' => 'object', 'required' => true, 'description' => 'Ephemeral push payload.'],
        ];
    }

    /**
     * Send an ephemeral payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->pushEphemeral($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
