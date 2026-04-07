<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a HubSpot company by ID.
 *
 * Returns the full company profile including all properties.
 */
class Hubspot3GetCompany implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_get_company';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a HubSpot company by its ID.
        Returns the full company profile including name, domain, industry, and other properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'company_id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot company ID.'],
        ];
    }

    /**
     * Retrieve a HubSpot company by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (company_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $id = $args['company_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('company_id is required.');
            }

            $result = $this->service->getCompany($id);

            $props = [];
            foreach ($result['properties'] ?? [] as $key => $val) {
                $props[$key] = $val['value'] ?? $val;
            }

            return ToolResult::success([
                'id' => $result['companyId'] ?? $result['id'] ?? '',
                'name' => $props['name'] ?? '',
                'domain' => $props['domain'] ?? '',
                'industry' => $props['industry'] ?? '',
                'properties' => $props,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
