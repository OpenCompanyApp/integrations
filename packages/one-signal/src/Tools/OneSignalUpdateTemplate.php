<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a OneSignal message template.
 */
class OneSignalUpdateTemplate extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_update_template';
    }

    public function description(): string
    {
        return 'Update a reusable push, email, or SMS template.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Template update payload.'],
        ];
    }

    /**
     * Execute template update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateTemplate(
            $args['app_id'] ?? null,
            $this->required($args, 'template_id'),
            $this->required($args, 'payload'),
        ));
    }
}
