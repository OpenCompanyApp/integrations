<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a OneSignal segment.
 */
class OneSignalCreateSegment extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_create_segment';
    }

    public function description(): string
    {
        return 'Create a segment with name and filters.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Segment payload with name and filters.'],
        ];
    }

    /**
     * Execute segment creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createSegment(
            $args['app_id'] ?? null,
            $this->required($args, 'payload'),
        ));
    }
}
