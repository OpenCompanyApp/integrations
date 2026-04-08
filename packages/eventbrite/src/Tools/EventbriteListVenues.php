<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List venues for the configured Eventbrite organization.
 *
 * Returns a paginated list of venues with name, address, and capacity.
 */
class EventbriteListVenues implements Tool
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
        return 'eventbrite_list_venues';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List venues for the Eventbrite organization. Returns paginated venues with name, address, city, and capacity.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'continuation' => ['type' => 'string', 'description' => 'Continuation token from a previous response.'],
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
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['continuation'])) {
                $params['continuation'] = $args['continuation'];
            }

            $result = $this->service->listVenues($params);

            $venues = $result['venues'] ?? [];
            $pagination = $result['pagination'] ?? [];

            $summary = array_map(function (array $venue): array {
                $address = $venue['address'] ?? [];

                return [
                    'id' => $venue['id'] ?? null,
                    'name' => $venue['name'] ?? null,
                    'address_1' => $address['address_1'] ?? null,
                    'address_2' => $address['address_2'] ?? null,
                    'city' => $address['city'] ?? null,
                    'region' => $address['region'] ?? null,
                    'postal_code' => $address['postal_code'] ?? null,
                    'country' => $address['country'] ?? null,
                    'latitude' => $venue['latitude'] ?? null,
                    'longitude' => $venue['longitude'] ?? null,
                    'capacity' => $venue['capacity'] ?? null,
                ];
            }, $venues);

            return ToolResult::success([
                'venues' => $summary,
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
