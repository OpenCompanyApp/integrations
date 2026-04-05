<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Track an event in Mixpanel.
 *
 * Sends an event to the Mixpanel Ingestion API with optional
 * properties, a distinct user ID, and a custom timestamp.
 */
class MixpanelTrackEvent implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_track_event';
    }

    public function description(): string
    {
        return 'Track an event in Mixpanel with optional properties and user identity.';
    }

    public function parameters(): array
    {
        return [
            'event'        => ['type' => 'string', 'required' => true, 'description' => 'Name of the event to track (e.g., "Page View", "Purchase").'],
            'properties'   => ['type' => 'string', 'description' => 'JSON object of event properties (e.g., {"page":"/home","source":"ad"}).'],
            'distinct_id'  => ['type' => 'string', 'description' => 'Distinct user ID to associate the event with.'],
            'time'         => ['type' => 'integer', 'description' => 'Unix timestamp for the event. Defaults to the current time.'],
        ];
    }

    /**
     * Track an event in Mixpanel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (event, properties, distinct_id, time)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $event = $args['event'] ?? '';

            if (empty($event)) {
                return ToolResult::error('event is required.');
            }

            $properties = $args['properties'] ?? [];
            if (is_string($properties)) {
                $properties = json_decode($properties, true) ?? [];
            }

            $distinctId = $args['distinct_id'] ?? '';
            $time = isset($args['time']) ? (int) $args['time'] : null;

            $result = $this->service->trackEvent($event, $properties, $distinctId, $time);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
