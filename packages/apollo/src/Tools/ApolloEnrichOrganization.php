<?php

namespace OpenCompany\Integrations\Apollo\Tools;

use RuntimeException;

/**
 * Enrich one organization by domain.
 */
class ApolloEnrichOrganization extends AbstractApolloTool
{
    protected const NAME = 'apollo_enrich_organization';

    protected const DESCRIPTION = 'Enrich one organization by domain using Apollo Organization Enrichment.';

    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Company domain without protocol or www.'],
    ];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        if (empty($args['domain'])) {
            throw new RuntimeException('domain is required.');
        }

        return $this->service->enrichOrganization((string) $args['domain']);
    }
}
