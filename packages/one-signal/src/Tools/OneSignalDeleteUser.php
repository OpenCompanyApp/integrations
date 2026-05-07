<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a OneSignal user by alias.
 */
class OneSignalDeleteUser extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_delete_user';
    }

    public function description(): string
    {
        return 'Delete a OneSignal user and all associated subscriptions by alias.';
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
     * Execute the user deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteUser(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
        ));
    }
}
