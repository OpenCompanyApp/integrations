<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Delete a Pushbullet channel subscription.
 *
 * Unsubscribes the authenticated user from the channel.
 */
class PushbulletDeleteSubscription implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_delete_subscription'; }

    public function description(): string { return 'Delete a Pushbullet channel subscription by subscription iden.'; }

    public function parameters(): array
    {
        return [
            'subscription_iden' => ['type' => 'string', 'required' => true, 'description' => 'Subscription iden to delete.'],
        ];
    }

    /**
     * Delete a Pushbullet subscription.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $this->service->deleteSubscription($args['subscription_iden'] ?? '');

            return ToolResult::success(['deleted' => true, 'subscription_iden' => $args['subscription_iden'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
