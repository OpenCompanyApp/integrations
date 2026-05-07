<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a mass payment.
 *
 * Maps to the official Dwolla endpoint GET /mass-payments/{id}.
 */
class DwollaGetMassPayment extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_mass_payment';
    protected const DESCRIPTION = 'Retrieve detailed information for a mass payment by its unique identifier. Returns the current processing status (pending, processing, or complete), creation date, metadata, and links to the source funding source and payment items. Use this endpoint to monitor mass payment processing progress and determine when to check individual item results.

Official Dwolla endpoint: GET /mass-payments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Mass payment unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/mass-payments/{id}';
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
