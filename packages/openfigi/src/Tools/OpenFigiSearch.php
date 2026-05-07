<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

/**
 * Search for FIGIs using keywords and optional filters.
 */
class OpenFigiSearch extends AbstractOpenFigiTool
{
    protected const NAME = 'openfigi_search';
    protected const DESCRIPTION = 'Search for FIGIs using keywords and optional OpenFIGI filter fields.';
    protected const METHOD = 'search';
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => false, 'description' => 'Search keywords.'],
        'start' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor from a previous next response.'],
        'exchCode' => ['type' => 'string', 'required' => false, 'description' => 'Exchange code filter.'],
        'micCode' => ['type' => 'string', 'required' => false, 'description' => 'MIC code filter.'],
        'currency' => ['type' => 'string', 'required' => false, 'description' => 'Currency filter.'],
        'marketSecDes' => ['type' => 'string', 'required' => false, 'description' => 'Market sector description filter.'],
        'securityType' => ['type' => 'string', 'required' => false, 'description' => 'Security type filter.'],
        'securityType2' => ['type' => 'string', 'required' => false, 'description' => 'Secondary security type filter.'],
        'payload' => ['type' => 'object', 'required' => false, 'description' => 'Additional official OpenFIGI search payload fields.'],
    ];
}
