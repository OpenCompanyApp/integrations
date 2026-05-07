<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a OneSignal user by alias.
 */
class OneSignalGetUser extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_get_user';
    }

    public function description(): string
    {
        return 'View a OneSignal user by alias, such as external_id or onesignal_id.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Alias label, usually external_id or onesignal_id.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Alias value.'],
        ];
    }

    /**
     * Execute the user fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getUser(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
        ));
    }
}
