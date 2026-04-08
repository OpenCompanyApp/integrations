<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Get a single Klaviyo event by ID.
 */
class KlaviyoGetEvent implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_get_event';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Klaviyo event by its ID.
        Returns the event with its metric name, properties, value, timestamp, and associated profile.
        MD;
    }

    public function parameters(): array
    {
        return [
            'event_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo event ID.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $eventId = $args['event_id'] ?? '';
            if (empty($eventId)) {
                return ToolResult::error('The "event_id" parameter is required.');
            }

            $result = $this->service->getEvent($eventId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
