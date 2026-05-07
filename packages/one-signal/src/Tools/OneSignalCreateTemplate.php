<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a OneSignal message template.
 */
class OneSignalCreateTemplate extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_template';
    }

    public function description(): string
    {
        return 'Create a reusable push, email, or SMS template.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Template payload.'],
        ];
    }

    /**
     * Execute template creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createTemplate(
            $args['app_id'] ?? null,
            $this->required($args, 'payload'),
        ));
    }
}
