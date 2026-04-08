<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Intercom contacts with pagination.
 *
 * Returns a paginated list of contacts with their IDs, emails, names, and roles.
 */
class IntercomListContacts implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_list_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        List Intercom contacts with pagination.
        Returns contact IDs, emails, names, and roles.
        Use limit and starting_after for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default 20).'],
            'starting_after' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List Intercom contacts with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listContacts($params);

            $contacts = array_map(function (array $contact): array {
                return [
                    'id' => $contact['id'] ?? '',
                    'email' => $contact['email'] ?? '',
                    'name' => $contact['name'] ?? '',
                    'role' => $contact['role'] ?? '',
                ];
            }, $result['data'] ?? []);

            $output = ['results' => $contacts, 'total' => $result['total_count'] ?? count($contacts)];

            if (isset($result['pages']['next']['starting_after'])) {
                $output['starting_after'] = $result['pages']['next']['starting_after'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
