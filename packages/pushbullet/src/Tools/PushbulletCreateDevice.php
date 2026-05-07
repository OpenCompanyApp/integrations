<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Create a Pushbullet device.
 *
 * Devices are targets that can receive pushes and participate in stream events.
 */
class PushbulletCreateDevice implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_create_device'; }

    public function description(): string { return 'Create a new Pushbullet device for the authenticated user.'; }

    public function parameters(): array
    {
        return [
            'nickname' => ['type' => 'string', 'required' => true, 'description' => 'Name to display for the device.'],
            'icon' => ['type' => 'string', 'description' => 'Device icon such as desktop, browser, laptop, tablet, phone, watch, or system.'],
            'model' => ['type' => 'string', 'description' => 'Device model.'],
            'manufacturer' => ['type' => 'string', 'description' => 'Device manufacturer.'],
            'push_token' => ['type' => 'string', 'description' => 'Platform-specific push token.'],
            'app_version' => ['type' => 'integer', 'description' => 'Pushbullet app version.'],
            'has_sms' => ['type' => 'boolean', 'description' => 'Whether the device has SMS capability.'],
        ];
    }

    /**
     * Create a Pushbullet device.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->createDevice($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
