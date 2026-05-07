<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List business classifications.
 *
 * Maps to the official Dwolla endpoint GET /business-classifications.
 */
class DwollaListBusinessClassifications extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_business_classifications';
    protected const DESCRIPTION = 'Returns a directory of business and industry classifications required for creating business verified customers. Each business classification contains multiple industry classifications. The industry classification ID must be provided in the businessClassification parameter during business customer creation for verification.

Official Dwolla endpoint: GET /business-classifications.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/business-classifications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
