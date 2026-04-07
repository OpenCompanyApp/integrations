<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Xero contacts with pagination.
 *
 * Returns a paginated list of contacts with their IDs, names, and emails.
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
        List Xero contacts with pagination.
        Returns contact IDs, names, emails, and types.
        Use page for pagination (1-indexed).
        MD;
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
            'where' => ['type' => 'string', 'description' => 'Xero where filter expression.'],
            'order' => ['type' => 'string', 'description' => 'Sort order (e.g. "Name ASC").'],
            'include_archived' => ['type' => 'boolean', 'description' => 'Include archived contacts (default false).'],
        ];
    }

    /**
     * List Xero contacts with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, where, order, include_archived)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (! empty($args['where'])) {
                $params['where'] = $args['where'];
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (isset($args['include_archived'])) {
                $params['includeArchived'] = $args['include_archived'] ? 'true' : 'false';
            }

            $result = $this->service->listContacts($params);

            $contacts = array_map(function (array $contact): array {
                return [
                    'id' => $contact['ContactID'] ?? '',
                    'name' => $contact['Name'] ?? '',
                    'email' => $contact['EmailAddress'] ?? '',
                    'type' => $contact['ContactStatus'] ?? '',
                    'is_customer' => $contact['IsSupplier'] ?? false ? false : true,
                    'is_supplier' => $contact['IsSupplier'] ?? false,
                ];
            }, $result['Contacts'] ?? []);

            return ToolResult::success([
                'results' => $contacts,
                'count' => count($contacts),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
