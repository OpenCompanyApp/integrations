<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a HubSpot contact by ID.
 *
 * Returns the full contact profile including all properties.
 */
class Hubspot3GetContact implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_get_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a HubSpot contact by its ID (vid).
        Returns the full contact profile including all properties, form submissions, and lists.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot contact ID (vid).'],
        ];
    }

    /**
     * Retrieve a HubSpot contact by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $id = $args['contact_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($id);

            $props = [];
            foreach ($result['properties'] ?? [] as $key => $val) {
                $props[$key] = $val['value'] ?? $val;
            }

            return ToolResult::success([
                'id' => $result['vid'] ?? $result['id'] ?? '',
                'email' => $props['email'] ?? '',
                'first_name' => $props['firstname'] ?? '',
                'last_name' => $props['lastname'] ?? '',
                'company' => $props['company'] ?? '',
                'properties' => $props,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
