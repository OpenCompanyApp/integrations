<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update OneSignal app configuration.
 */
class OneSignalUpdateApp extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_update_app';
    }

    public function description(): string
    {
        return 'Update app configuration. This may require an organization-scoped API key.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'App update payload.'],
        ];
    }

    /**
     * Execute app update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateApp(
            $args['app_id'] ?? null,
            $this->required($args, 'payload'),
        ));
    }
}
