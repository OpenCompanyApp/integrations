<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new company in HubSpot CRM.
 *
 * Supports standard company properties (name, domain) plus arbitrary custom properties.
 */
class HubSpotCreateCompany implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_company';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new company in HubSpot CRM.
        Supports name, domain, and any additional custom properties.
        Returns the created company with its HubSpot ID and properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Company name.'],
            'domain' => ['type' => 'string', 'description' => 'Company website domain.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a new HubSpot company with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, domain, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $properties = [];

            if (! empty($args['name'])) {
                $properties['name'] = $args['name'];
            }
            if (! empty($args['domain'])) {
                $properties['domain'] = $args['domain'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[$key] = $value;
                }
            }

            if (empty($properties)) {
                return ToolResult::error('At least one company property is required.');
            }

            $result = $this->service->createCompany($properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
