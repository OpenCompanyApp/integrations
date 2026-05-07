<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Update a Pushbullet device.
 *
 * Sends only provided fields to the Pushbullet device endpoint.
 */
class PushbulletUpdateDevice implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_update_device'; }

    public function description(): string { return 'Update a Pushbullet device such as nickname, icon, or SMS capability.'; }

    public function parameters(): array
    {
        return [
            'device_iden' => ['type' => 'string', 'required' => true, 'description' => 'Device iden to update.'],
            'nickname' => ['type' => 'string', 'description' => 'Updated device nickname.'],
            'icon' => ['type' => 'string', 'description' => 'Updated device icon.'],
            'model' => ['type' => 'string', 'description' => 'Updated model.'],
            'manufacturer' => ['type' => 'string', 'description' => 'Updated manufacturer.'],
            'push_token' => ['type' => 'string', 'description' => 'Updated push token.'],
            'app_version' => ['type' => 'integer', 'description' => 'Updated app version.'],
            'has_sms' => ['type' => 'boolean', 'description' => 'Updated SMS capability.'],
        ];
    }

    /**
     * Update a Pushbullet device.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $deviceIden = $args['device_iden'] ?? '';
            unset($args['device_iden']);

            if ($deviceIden === '') {
                return ToolResult::error('device_iden is required.');
            }

            return ToolResult::success($this->service->updateDevice($deviceIden, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
