<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve beneficial owner.
 *
 * Maps to the official Dwolla endpoint GET /beneficial-owners/{id}.
 */
class DwollaRetrieveBeneficialOwner extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retrieve_beneficial_owner';
    protected const DESCRIPTION = 'Returns detailed information for a specific beneficial owner, including personal information, address, and verification status. The verification status indicates the owner\'s identity verification progress and affects the business customer\'s transaction capabilities.

Official Dwolla endpoint: GET /beneficial-owners/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Beneficial owner unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/beneficial-owners/{id}';
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
