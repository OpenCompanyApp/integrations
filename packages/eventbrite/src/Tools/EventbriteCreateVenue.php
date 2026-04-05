<?php

namespace OpenCompany\Integrations\Eventbrite\Tools;

use OpenCompany\Integrations\Eventbrite\EventbriteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new venue on Eventbrite.
 *
 * Accepts venue details including name, address, city, region, postal code,
 * country, and optional latitude/longitude. Returns the created venue object.
 */
class EventbriteCreateVenue implements Tool
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
        return 'eventbrite_create_venue';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new venue on Eventbrite. Provide name and address details. Returns the venue ID for use when creating events.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Venue name (e.g. "Convention Center Hall A").'],
            'address_1' => ['type' => 'string', 'required' => true, 'description' => 'Street address.'],
            'city' => ['type' => 'string', 'required' => true, 'description' => 'City name.'],
            'region' => ['type' => 'string', 'description' => 'State or region.'],
            'postal_code' => ['type' => 'string', 'description' => 'ZIP or postal code.'],
            'country' => ['type' => 'string', 'required' => true, 'description' => 'Two-letter country code (e.g. "US", "GB", "NL").'],
            'latitude' => ['type' => 'string', 'description' => 'Latitude for map pin.'],
            'longitude' => ['type' => 'string', 'description' => 'Longitude for map pin.'],
            'capacity' => ['type' => 'integer', 'description' => 'Maximum venue capacity.'],
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

            $venueData = [
                'venue' => [
                    'name' => $args['name'],
                    'address' => [
                        'address_1' => $args['address_1'],
                        'city' => $args['city'],
                        'country' => $args['country'],
                    ],
                ],
            ];

            // Optional address fields
            if (isset($args['address_2'])) {
                $venueData['venue']['address']['address_2'] = $args['address_2'];
            }
            if (isset($args['region'])) {
                $venueData['venue']['address']['region'] = $args['region'];
            }
            if (isset($args['postal_code'])) {
                $venueData['venue']['address']['postal_code'] = $args['postal_code'];
            }
            if (isset($args['latitude'])) {
                $venueData['venue']['latitude'] = $args['latitude'];
            }
            if (isset($args['longitude'])) {
                $venueData['venue']['longitude'] = $args['longitude'];
            }
            if (isset($args['capacity'])) {
                $venueData['venue']['capacity'] = (int) $args['capacity'];
            }

            $result = $this->service->createVenue($venueData);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
