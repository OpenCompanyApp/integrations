<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Search net-new people in Apollo's database.
 */
class ApolloSearchPeople extends AbstractApolloTool
{
    protected const NAME = 'apollo_search_people';

    protected const DESCRIPTION = 'Search net-new people in Apollo using the documented People API Search endpoint. Use filters for official Apollo search parameters such as person_titles, person_locations, organization_ids, and pagination.';

    protected const PARAMETERS = [
        'q_keywords' => ['type' => 'string', 'description' => 'Keyword search across people records.'],
        'person_titles' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Job titles to include.'],
        'person_locations' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Person locations to include.'],
        'organization_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Apollo organization IDs to include.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page, up to Apollo limits.'],
        'filters' => ['type' => 'object', 'description' => 'Additional documented People API Search filters passed through to Apollo.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->searchPeople($this->filters($args));
    }
}
