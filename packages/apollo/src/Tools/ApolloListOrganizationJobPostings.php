<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * List job postings for an Apollo organization.
 */
class ApolloListOrganizationJobPostings extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_organization_job_postings';

    protected const DESCRIPTION = 'List current job postings for an Apollo organization ID.';

    protected const PARAMETERS = [
        'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Apollo organization ID.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (empty($args['organization_id'])) {
            throw new RuntimeException('organization_id is required.');
        }

        return $this->service->listOrganizationJobPostings((string) $args['organization_id'], $this->filters($args, ['organization_id']));
    }
}
