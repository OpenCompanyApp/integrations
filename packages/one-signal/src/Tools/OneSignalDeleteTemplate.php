<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a OneSignal message template.
 */
class OneSignalDeleteTemplate extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_delete_template';
    }

    public function description(): string
    {
        return 'Delete a message template by ID.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
        ];
    }

    /**
     * Execute template deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteTemplate(
            $args['app_id'] ?? null,
            $this->required($args, 'template_id'),
        ));
    }
}
