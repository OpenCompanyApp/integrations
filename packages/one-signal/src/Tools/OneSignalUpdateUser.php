<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update OneSignal user properties by alias.
 */
class OneSignalUpdateUser extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_update_user';
    }

    public function description(): string
    {
        return 'Update user-level properties or deltas for a OneSignal user located by alias.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Alias label.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Alias value.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'User update payload with properties and/or deltas.'],
        ];
    }

    /**
     * Execute the user update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateUser(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
            $this->required($args, 'payload'),
        ));
    }
}
