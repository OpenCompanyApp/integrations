<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a push, email, or SMS subscription for a user.
 */
class OneSignalCreateSubscription extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_subscription';
    }

    public function description(): string
    {
        return 'Create a subscription for a user identified by alias.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Alias label for the user.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Alias value for the user.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Subscription payload.'],
        ];
    }

    /**
     * Execute subscription creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createSubscription(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
            $this->required($args, 'payload'),
        ));
    }
}
