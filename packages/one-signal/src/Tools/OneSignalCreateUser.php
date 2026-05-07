<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a OneSignal user with aliases, properties, and subscriptions.
 */
class OneSignalCreateUser extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_user';
    }

    public function description(): string
    {
        return 'Create a OneSignal user with optional identity aliases, properties, and subscriptions.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'User payload containing identity, properties, and/or subscriptions.'],
        ];
    }

    /**
     * Execute user creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createUser(
            $args['app_id'] ?? null,
            $this->required($args, 'payload'),
        ));
    }
}
