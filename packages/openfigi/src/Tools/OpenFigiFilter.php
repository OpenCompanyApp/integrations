<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

/**
 * Filter for FIGIs using OpenFIGI instrument filters.
 */
class OpenFigiFilter extends AbstractOpenFigiTool
{
    protected const NAME = 'openfigi_filter';
    protected const DESCRIPTION = 'Filter for FIGIs using OpenFIGI instrument filters. This endpoint supersedes search for most workflows.';
    protected const METHOD = 'filter';
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => false, 'description' => 'Optional keywords.'],
        'start' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor from a previous next response.'],
        'exchCode' => ['type' => 'string', 'required' => false, 'description' => 'Exchange code filter.'],
        'micCode' => ['type' => 'string', 'required' => false, 'description' => 'MIC code filter.'],
        'currency' => ['type' => 'string', 'required' => false, 'description' => 'Currency filter.'],
        'marketSecDes' => ['type' => 'string', 'required' => false, 'description' => 'Market sector description filter.'],
        'securityType' => ['type' => 'string', 'required' => false, 'description' => 'Security type filter.'],
        'securityType2' => ['type' => 'string', 'required' => false, 'description' => 'Secondary security type filter.'],
        'includeUnlistedEquities' => ['type' => 'boolean', 'required' => false, 'description' => 'Include unlisted equities where supported.'],
        'optionType' => ['type' => 'string', 'required' => false, 'description' => 'Option type filter.'],
        'strike' => ['type' => 'number', 'required' => false, 'description' => 'Option strike filter.'],
        'expiration' => ['type' => 'string', 'required' => false, 'description' => 'Option expiration date filter.'],
        'maturity' => ['type' => 'string', 'required' => false, 'description' => 'Fixed-income maturity date filter.'],
        'stateCode' => ['type' => 'string', 'required' => false, 'description' => 'US municipal state code filter.'],
        'payload' => ['type' => 'object', 'required' => false, 'description' => 'Additional official OpenFIGI filter payload fields.'],
    ];
}
