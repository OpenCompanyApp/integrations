<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch user identity aliases by subscription ID.
 */
class OneSignalGetIdentityBySubscription extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_get_identity_by_subscription';
    }

    public function description(): string
    {
        return 'Fetch the user identity aliases associated with a subscription ID.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID.'],
        ];
    }

    /**
     * Execute identity lookup by subscription.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getIdentityBySubscription(
            $args['app_id'] ?? null,
            $this->required($args, 'subscription_id'),
        ));
    }
}
