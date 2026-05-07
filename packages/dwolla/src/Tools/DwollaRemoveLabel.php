<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Remove a label.
 *
 * Maps to the official Dwolla endpoint DELETE /labels/{id}.
 */
class DwollaRemoveLabel extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_remove_label';
    protected const DESCRIPTION = 'Delete a Label to stop tracking funds and remove it from your account. Returns success status if the Label is successfully removed. Use this to streamline your account management and remove unused Labels from your system.

Official Dwolla endpoint: DELETE /labels/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A label unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/labels/{id}';
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
