<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a transfer failure reason.
 *
 * Maps to the official Dwolla endpoint GET /transfers/{id}/failure.
 */
class DwollaGetTransferFailureReason extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_transfer_failure_reason';
    protected const DESCRIPTION = 'Retrieve a transfer failure reason

Official Dwolla endpoint: GET /transfers/{id}/failure.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Transfer unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/transfers/{id}/failure';
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
