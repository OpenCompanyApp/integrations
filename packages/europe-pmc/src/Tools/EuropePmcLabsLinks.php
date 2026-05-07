<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve third-party external links for an article.
 */
class EuropePmcLabsLinks extends EuropePmcReferences
{
    protected const NAME = 'europe_pmc_labs_links';
    protected const DESCRIPTION = 'Retrieve Europe PMC Labs external links for a source and identifier, optionally filtered by provider.';
    protected const PATH = '{source}/{id}/labsLinks';
    protected const PARAMETERS = [
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Source code such as MED or PMC.'],
        'id' => ['type' => 'string', 'required' => true, 'description' => 'External article identifier.'],
        'providerId' => ['type' => 'string', 'required' => false, 'description' => 'Optional external link provider ID.'],
    ];
}
