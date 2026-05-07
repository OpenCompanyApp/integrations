<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create an on-demand transfer authorization.
 *
 * Maps to the official Dwolla endpoint POST /on-demand-authorizations.
 */
class DwollaCreateOnDemandTransferAuthorization extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_on_demand_transfer_authorization';
    protected const DESCRIPTION = 'Create an on-demand transfer authorization that allows Customers to pre-authorize variable amount ACH transfers from their bank account for future payments. This authorization is used when creating Customer funding sources to enable flexible payment processing. Returns UI text elements including authorization body text and button text for display in your application\'s bank account addition flow.

Official Dwolla endpoint: POST /on-demand-authorizations.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/on-demand-authorizations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
