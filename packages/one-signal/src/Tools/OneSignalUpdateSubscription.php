<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a OneSignal subscription by ID.
 */
class OneSignalUpdateSubscription extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_update_subscription';
    }

    public function description(): string
    {
        return 'Update a subscription by ID, such as tags, enabled state, or channel properties.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Subscription update payload.'],
        ];
    }

    /**
     * Execute subscription update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateSubscription(
            $args['app_id'] ?? null,
            $this->required($args, 'subscription_id'),
            $this->required($args, 'payload'),
        ));
    }
}
