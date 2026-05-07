<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch all aliases for a OneSignal user.
 */
class OneSignalGetUserIdentity extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_get_user_identity';
    }

    public function description(): string
    {
        return 'Fetch the identity aliases for a OneSignal user located by alias.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Alias label.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Alias value.'],
        ];
    }

    /**
     * Execute the identity fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getUserIdentity(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
        ));
    }
}
