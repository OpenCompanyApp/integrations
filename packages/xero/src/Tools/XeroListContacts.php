<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero contacts with optional search, pagination, and ordering.
 *
 * Supports searching by name and paginating results.
 */
class XeroListContacts implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_list_contacts';
    }

    public function description(): string
    {
        return <<<'MD'
        List Xero contacts with optional search, pagination, and ordering.
        Use the search parameter to filter contacts by name.
        MD;
    }

    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search term to filter contacts by name.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
            'order' => ['type' => 'string', 'description' => 'Sort order, e.g. "Name ASC" or "Name DESC".'],
        ];
    }

    /**
     * List Xero contacts with optional search and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (search, page, order)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (! empty($args['search'])) {
                $params['where'] = 'Name.Contains("' . $args['search'] . '")';
            }
            if (! empty($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }

            $result = $this->service->listContacts($params);

            $contacts = array_map(function (array $c) {
                return [
                    'id' => $c['ContactID'] ?? '',
                    'name' => $c['Name'] ?? '',
                    'email' => $c['EmailAddress'] ?? '',
                    'status' => $c['ContactStatus'] ?? '',
                    'is_customer' => $c['IsCustomer'] ?? false,
                    'is_supplier' => $c['IsSupplier'] ?? false,
                ];
            }, $result['Contacts'] ?? []);

            return ToolResult::success([
                'contacts' => $contacts,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
