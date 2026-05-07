<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve evaluations for a Europe PMC article.
 */
class EuropePmcEvaluations extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_evaluations';
    protected const DESCRIPTION = 'Retrieve evaluations for a given Europe PMC publication.';
    protected const PATH = 'evaluations/{source}/{id}';
    protected const PATH_PARAMS = ['source', 'id'];
    protected const DEFAULTS = ['format' => 'json'];
    protected const PARAMETERS = [
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Source code such as MED or PMC.'],
        'id' => ['type' => 'string', 'required' => true, 'description' => 'External article identifier.'],
    ];
}
