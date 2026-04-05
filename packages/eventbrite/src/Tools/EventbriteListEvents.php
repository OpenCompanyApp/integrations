<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List events for the configured Eventbrite organization.
 *
 * Returns a paginated list of events with key details such as name, status,
 * start/end times, and URL. Use query parameters to filter by status or
 * change the sort order.
 */
class EventbriteListEvents implements Tool
{
    /**
     * Create a new tool instance.
     */
    public function __construct(
        private EventbriteService $service,
    ) {}

    /**
     * The tool name used for dispatch.
     */
    public function name(): string
    {
        return 'eventbrite_list_events';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List events for the Eventbrite organization. Returns paginated events with name, status, dates, and URL. Filter by status (live, draft, started, ended, completed, canceled) or order results.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by status: live, draft, started, ended, completed, canceled, or all.'],
            'order_by' => ['type' => 'string', 'description' => 'Sort order: start_asc, start_desc, created_asc, created_desc, or name_asc.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'continuation' => ['type' => 'string', 'description' => 'Continuation token from a previous response for cursor-based pagination.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eventbrite integration is not configured. Provide a token and organization ID.');
            }

            $params = [];
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['order_by'])) {
                $params['order_by'] = $args['order_by'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['continuation'])) {
                $params['continuation'] = $args['continuation'];
            }

            $result = $this->service->listEvents($params);

            $events = $result['events'] ?? [];
            $pagination = $result['pagination'] ?? [];

            $summary = array_map(function (array $event): array {
                return [
                    'id' => $event['id'] ?? null,
                    'name' => $event['name']['text'] ?? null,
                    'status' => $event['status'] ?? null,
                    'start' => $event['start']['utc'] ?? null,
                    'end' => $event['end']['utc'] ?? null,
                    'url' => $event['url'] ?? null,
                    'currency' => $event['currency'] ?? null,
                ];
            }, $events);

            return ToolResult::success([
                'events' => $summary,
                'pagination' => [
                    'has_more_items' => $pagination['has_more_items'] ?? false,
                    'page_number' => $pagination['page_number'] ?? 1,
                    'page_size' => $pagination['page_size'] ?? count($summary),
                    'continuation' => $pagination['continuation'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
