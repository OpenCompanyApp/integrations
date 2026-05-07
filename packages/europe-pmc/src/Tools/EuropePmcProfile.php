<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Get Europe PMC hit-count profiles for a query.
 */
class EuropePmcProfile extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_profile';
    protected const DESCRIPTION = 'Return Europe PMC hit-count profiles by publication type, data source, and subset for a query.';
    protected const PATH = 'profile';
    protected const DEFAULTS = ['format' => 'json'];
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Europe PMC query syntax.'],
    ];
}
