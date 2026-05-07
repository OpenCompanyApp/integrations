<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Enrich up to 10 organizations by domain.
 */
class ApolloBulkEnrichOrganizations extends AbstractApolloTool
{
    protected const NAME = 'apollo_bulk_enrich_organizations';

    protected const DESCRIPTION = 'Bulk enrich up to 10 organizations by domain using Apollo Bulk Organization Enrichment.';

    protected const PARAMETERS = [
        'domains' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Company domains, maximum 10.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (! is_array($args['domains'] ?? null)) {
            throw new RuntimeException('domains must be an array.');
        }

        return $this->service->bulkEnrichOrganizations($args['domains']);
    }
}
