<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Remove beneficial owner.
 *
 * Maps to the official Dwolla endpoint DELETE /beneficial-owners/{id}.
 */
class DwollaDeleteBeneficialOwner extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_delete_beneficial_owner';
    protected const DESCRIPTION = 'Permanently removes a beneficial owner from a business customer. This action is irreversible and the beneficial owner cannot be retrieved after removal. Removing a beneficial owner will change the customer\'s certification status to "recertify".

Official Dwolla endpoint: DELETE /beneficial-owners/{id}.';
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
    protected const METHOD = 'DELETE';
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
