<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new deal in HubSpot CRM.
 *
 * Supports standard deal properties (dealname, amount, pipeline, dealstage, closedate) plus custom properties.
 */
class HubSpotCreateDeal implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_deal';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new deal in HubSpot CRM.
        Supports dealname, amount, pipeline, dealstage, closedate, and any additional custom properties.
        Returns the created deal with its HubSpot ID and properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'dealname' => ['type' => 'string', 'description' => 'Deal name.'],
            'amount' => ['type' => 'string', 'description' => 'Deal amount.'],
            'pipeline' => ['type' => 'string', 'description' => 'Pipeline ID or internal name.'],
            'dealstage' => ['type' => 'string', 'description' => 'Deal stage ID or internal name.'],
            'closedate' => ['type' => 'string', 'description' => 'Expected close date (ISO 8601 or milliseconds timestamp).'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a new HubSpot deal with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (dealname, amount, pipeline, dealstage, closedate, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $properties = [];

            if (! empty($args['dealname'])) {
                $properties['dealname'] = $args['dealname'];
            }
            if (! empty($args['amount'])) {
                $properties['amount'] = $args['amount'];
            }
            if (! empty($args['pipeline'])) {
                $properties['pipeline'] = $args['pipeline'];
            }
            if (! empty($args['dealstage'])) {
                $properties['dealstage'] = $args['dealstage'];
            }
            if (! empty($args['closedate'])) {
                $properties['closedate'] = $args['closedate'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[$key] = $value;
                }
            }

            if (empty($properties)) {
                return ToolResult::error('At least one deal property is required.');
            }

            $result = $this->service->createDeal($properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
