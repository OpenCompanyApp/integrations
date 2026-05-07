<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove an alias from a OneSignal user.
 */
class OneSignalDeleteAlias extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_delete_alias';
    }

    public function description(): string
    {
        return 'Remove a specific alias from a OneSignal user without deleting the user.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'alias_label' => ['type' => 'string', 'required' => true, 'description' => 'Known alias label.'],
            'alias_id' => ['type' => 'string', 'required' => true, 'description' => 'Known alias value.'],
            'alias_label_to_delete' => ['type' => 'string', 'required' => true, 'description' => 'Alias label to remove.'],
        ];
    }

    /**
     * Execute alias deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteAlias(
            $args['app_id'] ?? null,
            $this->required($args, 'alias_label'),
            $this->required($args, 'alias_id'),
            $this->required($args, 'alias_label_to_delete'),
        ));
    }
}
