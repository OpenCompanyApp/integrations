<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Migrate a legacy Pushover user key into a subscription-scoped user key.
 */
class PushoverMigrateSubscriptionUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_migrate_subscription_user';
    }

    public function description(): string
    {
        return 'Create a Pushover subscription for an existing user key and return the subscription-scoped user key.';
    }

    public function parameters(): array
    {
        return [
            'subscription' => ['type' => 'string', 'required' => true, 'description' => 'Pushover subscription code.'],
            'user_key' => ['type' => 'string', 'required' => true, 'description' => 'Existing Pushover user key to migrate.'],
            'device_name' => ['type' => 'string', 'description' => 'Optional device name to limit the subscription to.'],
            'sound' => ['type' => 'string', 'description' => 'Optional default notification sound for this subscribed user.'],
        ];
    }

    /**
     * Migrate a legacy user key to a subscription user key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (subscription, user_key, device_name, sound).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $subscription = $args['subscription'] ?? '';
            $userKey = $args['user_key'] ?? '';
            if ($subscription === '' || $userKey === '') {
                return ToolResult::error('subscription and user_key are required.');
            }

            $data = [];
            foreach (['device_name', 'sound'] as $key) {
                if (! empty($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->migrateSubscriptionUser($subscription, $userKey, $data));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
