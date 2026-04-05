<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a single-use Calendly scheduling link.
 *
 * Generates a temporary link that can be shared for booking a specific
 * event type, with an optional maximum event count.
 */
class CalendlyCreateSingleUseLink implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_create_single_use_link';
    }

    public function description(): string
    {
        return 'Create a single-use Calendly scheduling link.';
    }

    public function parameters(): array
    {
        return [
            'owner_uri' => ['type' => 'string', 'required' => true, 'description' => 'The URI of the event type or user to create the link for (e.g. https://api.calendly.com/event_types/...).'],
            'max_event_count' => ['type' => 'integer', 'description' => 'Maximum number of events that can be booked using this link. Default is 1.'],
            'link_type' => ['type' => 'string', 'description' => 'Type of scheduling link: "singe_use" (one-off) or "multi_use". Default is "singe_use".', 'enum' => ['singe_use', 'multi_use'], 'default' => 'singe_use'],
        ];
    }

    /**
     * Create a single-use scheduling link.
     *
     * @param  array<string, mixed>  $args  Tool arguments (owner_uri, max_event_count, link_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $ownerUri = $args['owner_uri'] ?? '';
            if (empty($ownerUri)) {
                return ToolResult::error('owner_uri is required.');
            }

            $data = [
                'owner' => $ownerUri,
                'link_type' => $args['link_type'] ?? 'singe_use',
            ];

            if (isset($args['max_event_count'])) {
                $data['max_event_count'] = (int) $args['max_event_count'];
            }

            $result = $this->service->createSingleUseLink($data);

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
