<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Update an existing Pushbullet push.
 *
 * Most commonly used to set dismissed state.
 */
class PushbulletUpdatePush implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_update_push'; }

    public function description(): string { return 'Update an existing Pushbullet push, such as marking it dismissed.'; }

    public function parameters(): array
    {
        return [
            'push_iden' => ['type' => 'string', 'required' => true, 'description' => 'Push iden to update.'],
            'dismissed' => ['type' => 'boolean', 'description' => 'Whether the push is dismissed.'],
        ];
    }

    /**
     * Update a push.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $pushIden = $args['push_iden'] ?? '';
            unset($args['push_iden']);

            if ($pushIden === '') {
                return ToolResult::error('push_iden is required.');
            }

            return ToolResult::success($this->service->updatePush($pushIden, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
