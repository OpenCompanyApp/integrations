<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Search the Europe PMC GRIST grants database.
 */
class EuropePmcGrantsSearch extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_grants_search';
    protected const DESCRIPTION = 'Search the Europe PMC GRIST grants database with keyword or fielded grant queries.';
    protected const API = 'grants';
    protected const DEFAULTS = ['format' => 'json', 'resultType' => 'lite'];
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'GRIST query, such as pi:smith or ga:"Wellcome Trust".'],
        'resultType' => ['type' => 'string', 'required' => false, 'description' => 'lite or core. Defaults to lite.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number. GRIST pages start at 1.'],
    ];
}
