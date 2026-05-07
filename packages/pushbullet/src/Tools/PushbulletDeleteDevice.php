<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Delete a Pushbullet device.
 *
 * Removes the device record from the authenticated account.
 */
class PushbulletDeleteDevice implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_delete_device'; }

    public function description(): string { return 'Delete a Pushbullet device by device iden.'; }

    public function parameters(): array
    {
        return [
            'device_iden' => ['type' => 'string', 'required' => true, 'description' => 'Device iden to delete.'],
        ];
    }

    /**
     * Delete a Pushbullet device.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $this->service->deleteDevice($args['device_iden'] ?? '');

            return ToolResult::success(['deleted' => true, 'device_iden' => $args['device_iden'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
