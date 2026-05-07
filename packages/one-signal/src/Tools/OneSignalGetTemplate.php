<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a OneSignal template by ID.
 */
class OneSignalGetTemplate extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_get_template';
    }

    public function description(): string
    {
        return 'Get a message template by ID.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
        ];
    }

    /**
     * Execute template fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getTemplate(
            $args['app_id'] ?? null,
            $this->required($args, 'template_id'),
        ));
    }
}
