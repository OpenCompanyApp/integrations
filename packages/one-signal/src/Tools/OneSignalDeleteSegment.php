<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a OneSignal segment.
 */
class OneSignalDeleteSegment extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_delete_segment';
    }

    public function description(): string
    {
        return 'Delete a segment by ID.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
        ];
    }

    /**
     * Execute segment deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteSegment(
            $args['app_id'] ?? null,
            $this->required($args, 'segment_id'),
        ));
    }
}
