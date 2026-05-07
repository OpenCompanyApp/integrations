<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a OneSignal segment.
 */
class OneSignalUpdateSegment extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_update_segment';
    }

    public function description(): string
    {
        return 'Update a segment name or filters.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Segment update payload.'],
        ];
    }

    /**
     * Execute segment update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateSegment(
            $args['app_id'] ?? null,
            $this->required($args, 'segment_id'),
            $this->required($args, 'payload'),
        ));
    }
}
