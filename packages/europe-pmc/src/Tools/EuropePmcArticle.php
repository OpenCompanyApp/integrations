<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve one Europe PMC article by source and identifier.
 */
class EuropePmcArticle extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_article';
    protected const DESCRIPTION = 'Retrieve one Europe PMC publication by source and external ID.';
    protected const PATH = 'article/{source}/{id}';
    protected const PATH_PARAMS = ['source', 'id'];
    protected const DEFAULTS = ['format' => 'json', 'resultType' => 'core'];
    protected const PARAMETERS = [
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Source code such as MED, PMC, AGR, or PAT.'],
        'id' => ['type' => 'string', 'required' => true, 'description' => 'External article identifier.'],
        'resultType' => ['type' => 'string', 'required' => false, 'description' => 'lite or core. Defaults to core.'],
    ];
}
