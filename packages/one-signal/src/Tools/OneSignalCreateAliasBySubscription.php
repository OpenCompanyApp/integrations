<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create aliases for a OneSignal user via subscription ID.
 */
class OneSignalCreateAliasBySubscription extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_alias_by_subscription';
    }

    public function description(): string
    {
        return 'Create or update aliases for the user associated with a known subscription ID.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'subscription_id' => ['type' => 'string', 'required' => true, 'description' => 'Subscription ID.'],
            'identity' => ['type' => 'object', 'required' => true, 'description' => 'Aliases to add or update.'],
        ];
    }

    /**
     * Execute alias creation by subscription.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createAliasBySubscription(
            $args['app_id'] ?? null,
            $this->required($args, 'subscription_id'),
            $this->required($args, 'identity'),
        ));
    }
}
