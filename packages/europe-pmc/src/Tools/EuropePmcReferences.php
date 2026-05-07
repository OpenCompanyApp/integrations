<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * List references cited by a Europe PMC article.
 */
class EuropePmcReferences extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_references';
    protected const DESCRIPTION = 'Retrieve a count and list of publications referenced by a Europe PMC article.';
    protected const PATH = '{source}/{id}/references';
    protected const PATH_PARAMS = ['source', 'id'];
    protected const DEFAULTS = ['format' => 'json'];
    protected const PARAMETERS = [
        'source' => ['type' => 'string', 'required' => true, 'description' => 'Source code such as MED or PMC.'],
        'id' => ['type' => 'string', 'required' => true, 'description' => 'External article identifier.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number where supported.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Page size where supported.'],
    ];
}
