<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List invitees for a scheduled Calendly event.
 *
 * Retrieves all invitees associated with a specific scheduled event,
 * supporting pagination.
 */
class CalendlyListInvitees implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_invitees';
    }

    public function description(): string
    {
        return 'List invitees for a scheduled Calendly event.';
    }

    public function parameters(): array
    {
        return [
            'event_uuid' => ['type' => 'string', 'required' => true, 'description' => 'The scheduled event UUID.'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
            'count' => ['type' => 'integer', 'description' => 'Number of invitees to return per page (default 20, max 100).'],
        ];
    }

    /**
     * List invitees for a scheduled event with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (event_uuid, page_token, count)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $eventUuid = $args['event_uuid'] ?? '';
            if (empty($eventUuid)) {
                return ToolResult::error('event_uuid is required.');
            }

            $params = [];

            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }

            $result = $this->service->listInvitees($eventUuid, $params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
