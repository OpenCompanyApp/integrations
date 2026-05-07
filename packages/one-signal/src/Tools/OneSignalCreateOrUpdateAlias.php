<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update aliases for an existing OneSignal user.
 */
class OneSignalCreateOrUpdateAlias extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_or_update_alias';
    }

    public function description(): string
    {
        return 'Create or update one or more identity aliases for a OneSignal user.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Known alias label.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Known alias value.'],
            'identity' => ['type' => 'object', 'required' => true, 'description' => 'Aliases to add or update.'],
        ];
    }

    /**
     * Execute alias upsert.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createOrUpdateAlias(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
            $this->required($args, 'identity'),
        ));
    }
}
