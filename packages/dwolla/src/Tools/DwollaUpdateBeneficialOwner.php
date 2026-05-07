<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Update beneficial owner.
 *
 * Maps to the official Dwolla endpoint POST /beneficial-owners/{id}.
 */
class DwollaUpdateBeneficialOwner extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_update_beneficial_owner';
    protected const DESCRIPTION = 'Updates a beneficial owner\'s information to retry verification when their status is "incomplete". Only beneficial owners with incomplete verification status can be updated. Used to correct information that caused initial verification to fail.

Official Dwolla endpoint: POST /beneficial-owners/{id}.';
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
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/beneficial-owners/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
