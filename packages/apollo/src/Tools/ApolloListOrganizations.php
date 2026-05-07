<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Search organizations in Apollo's company database.
 */
class ApolloListOrganizations extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_organizations';

    protected const DESCRIPTION = 'Search organizations in Apollo using the documented Organization Search endpoint. The slug is retained for compatibility; this is an organization search operation.';

    protected const PARAMETERS = [
        'q_organization_name' => ['type' => 'string', 'description' => 'Company name keyword.'],
        'q_organization_domains_list' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Company domains to include.'],
        'organization_locations' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Headquarters locations to include.'],
        'organization_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Apollo organization IDs to include.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'filters' => ['type' => 'object', 'description' => 'Additional documented Organization Search filters passed through to Apollo.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->searchOrganizations($this->filters($args));
    }
}
