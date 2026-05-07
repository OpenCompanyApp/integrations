<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Initiate or Verify micro-deposits.
 *
 * Maps to the official Dwolla endpoint POST /funding-sources/{id}/micro-deposits.
 */
class DwollaInitiateOrVerifyMicroDeposits extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_initiate_or_verify_micro_deposits';
    protected const DESCRIPTION = 'Handles micro-deposit bank verification process. Make a request without a request body to initiate two small deposits to the customer\'s bank account. Include deposit amounts to verify the received values and complete verification.

Official Dwolla endpoint: POST /funding-sources/{id}/micro-deposits.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the FS to initiate or verify micro-deposit',
        ],
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
    protected const PATH = '/funding-sources/{id}/micro-deposits';
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
