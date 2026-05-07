<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a business classification.
 *
 * Maps to the official Dwolla endpoint GET /business-classifications/{id}.
 */
class DwollaRetrieveBusinessClassification extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retrieve_business_classification';
    protected const DESCRIPTION = 'Returns a specific business classification with its embedded industry classifications. Use this endpoint to browse available industry options within a business category and obtain the industry classification ID required for the businessClassification parameter when creating business verified customers.

Official Dwolla endpoint: GET /business-classifications/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'business classification unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/business-classifications/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
