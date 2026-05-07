<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Track a ChurnZero event for an account and optional contact.
 *
 * Supports the core trackEvent parameters used by ChurnZero's HTTP API.
 */
class ChurnZeroTrackEvent implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_track_event';
    }

    public function description(): string
    {
        return 'Track a ChurnZero event for an account and optionally a contact. Event names are created by ChurnZero if they do not already exist.';
    }

    public function parameters(): array
    {
        return [
            'account_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Account identifier from your source system.'],
            'event_name' => ['type' => 'string', 'required' => true, 'description' => 'ChurnZero event name.'],
            'contact_external_id' => ['type' => 'string', 'description' => 'Contact identifier from your source system.'],
            'description' => ['type' => 'string', 'description' => 'Optional event description.'],
            'quantity' => ['type' => 'number', 'description' => 'Optional numeric quantity associated with the event.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Optional custom field map for the event.'],
        ];
    }

    /**
     * Track a ChurnZero event.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $customFields = $args['custom_fields'] ?? [];
            if (! is_array($customFields)) {
                return ToolResult::error('custom_fields must be an object when provided.');
            }

            $result = $this->service->trackEvent(
                (string) $args['account_external_id'],
                (string) $args['event_name'],
                isset($args['contact_external_id']) ? (string) $args['contact_external_id'] : null,
                isset($args['description']) ? (string) $args['description'] : null,
                isset($args['quantity']) ? (float) $args['quantity'] : null,
                $customFields,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
