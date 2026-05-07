<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Search saved accounts in Apollo.
 */
class ApolloSearchAccounts extends AbstractApolloTool
{
    protected const NAME = 'apollo_search_accounts';

    protected const DESCRIPTION = 'Search accounts saved in your Apollo team account. To search all companies in Apollo data, use apollo_list_organizations.';

    protected const PARAMETERS = [
        'q_organization_name' => ['type' => 'string', 'description' => 'Account name keyword.'],
        'account_stage_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Account stage IDs to include.'],
        'account_label_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Account label IDs to include.'],
        'sort_by_field' => ['type' => 'string', 'description' => 'Apollo account sort field.'],
        'sort_ascending' => ['type' => 'boolean', 'description' => 'Sort ascending when sort_by_field is set.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'filters' => ['type' => 'object', 'description' => 'Additional documented Search Accounts filters.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->searchAccounts($this->filters($args));
    }
}
