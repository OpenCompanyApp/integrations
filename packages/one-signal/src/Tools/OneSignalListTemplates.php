<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List OneSignal message templates.
 */
class OneSignalListTemplates extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_list_templates';
    }

    public function description(): string
    {
        return 'List message templates for an app with pagination.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum templates to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * Execute template listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listTemplates(
            $args['app_id'] ?? null,
            $this->only($args, ['limit', 'offset']),
        ));
    }
}
