<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List OneSignal segments for an app.
 */
class OneSignalListSegments extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_list_segments';
    }

    public function description(): string
    {
        return 'List segments for an app with pagination.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * Execute segment listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSegments(
            $args['app_id'] ?? null,
            $this->only($args, ['limit', 'offset']),
        ));
    }
}
