<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * Search saved contacts in the team's Apollo account.
 */
class ApolloSearchContacts extends AbstractApolloTool
{
    protected const NAME = 'apollo_search_contacts';

    protected const DESCRIPTION = 'Search contacts saved in your Apollo team account. To search net-new people in Apollo data, use apollo_search_people instead.';

    protected const PARAMETERS = [
        'q_keywords' => ['type' => 'string', 'description' => 'Keywords such as name, title, employer, or email.'],
        'q' => ['type' => 'string', 'description' => 'Legacy alias for q_keywords.'],
        'contact_stage_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Contact stage IDs to include.'],
        'contact_label_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Contact label IDs to include.'],
        'sort_by_field' => ['type' => 'string', 'description' => 'Apollo contact sort field.'],
        'sort_ascending' => ['type' => 'boolean', 'description' => 'Sort ascending when sort_by_field is set.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'filters' => ['type' => 'object', 'description' => 'Additional documented Search Contacts filters.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (isset($args['q']) && ! isset($args['q_keywords'])) {
            $args['q_keywords'] = $args['q'];
        }

        unset($args['q']);

        return $this->service->searchContacts($this->filters($args));
    }
}
