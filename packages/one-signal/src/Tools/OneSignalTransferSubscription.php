<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Transfer a subscription to another OneSignal user identity.
 */
class OneSignalTransferSubscription extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_transfer_subscription';
    }

    public function description(): string
    {
        return 'Transfer a subscription to another user identity within the same app.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID.'],
            'identity' => ['type' => 'object', 'required' => true, 'description' => 'Destination identity with exactly one alias.'],
        ];
    }

    /**
     * Execute subscription transfer.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->transferSubscription(
            $args['app_id'] ?? null,
            $this->required($args, 'subscription_id'),
            $this->required($args, 'identity'),
        ));
    }
}
