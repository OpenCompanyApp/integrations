<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a OneSignal segment by ID.
 */
class OneSignalGetSegment extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_get_segment';
    }

    public function description(): string
    {
        return 'Get a segment by ID and optionally include segment filters.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
            'segment_id' => ['type' => 'string', 'required' => true, 'description' => 'Segment ID.'],
            'include-segment-detail' => ['type' => 'boolean', 'description' => 'Include segment metadata and filters.'],
        ];
    }

    /**
     * Execute segment fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSegment(
            $args['app_id'] ?? null,
            $this->required($args, 'segment_id'),
            $this->only($args, ['include-segment-detail']),
        ));
    }
}
