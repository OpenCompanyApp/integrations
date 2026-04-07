<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot contacts.
 *
 * Returns a paginated list of contacts with their IDs and properties.
 */
class Hubspot3ListContacts implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_list_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot contacts.
        Returns contact IDs, emails, names, and associated company IDs.
        Use limit and offset for pagination, and properties to select specific fields.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default 20, max 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (vid offset for continuing results).'],
            'properties' => ['type' => 'string', 'description' => 'Comma-separated list of contact properties to include (e.g. "email,firstname,lastname,company").'],
        ];
    }

    /**
     * List HubSpot contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['count'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['vidOffset'] = (int) $args['offset'];
            }
            if (isset($args['properties'])) {
                $props = explode(',', (string) $args['properties']);
                $params['property'] = array_map('trim', $props);
            }

            $result = $this->service->listContacts($params);

            $contacts = array_map(function (array $contact): array {
                $props = [];
                foreach ($contact['properties'] ?? [] as $key => $val) {
                    $props[$key] = $val['value'] ?? $val;
                }

                return [
                    'id' => $contact['vid'] ?? $contact['id'] ?? '',
                    'email' => $props['email'] ?? '',
                    'first_name' => $props['firstname'] ?? '',
                    'last_name' => $props['lastname'] ?? '',
                    'company' => $props['company'] ?? '',
                    'properties' => $props,
                ];
            }, $result['contacts'] ?? []);

            $output = ['results' => $contacts];

            if (isset($result['vid-offset'])) {
                $output['next_offset'] = $result['vid-offset'];
            }
            if (isset($result['has-more'])) {
                $output['has_more'] = $result['has-more'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
