<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Update a mass payment.
 *
 * Maps to the official Dwolla endpoint POST /mass-payments/{id}.
 */
class DwollaUpdateMassPayment extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_update_mass_payment';
    protected const DESCRIPTION = 'Update the status of a deferred mass payment to control its processing lifecycle. Set status to `pending` to trigger processing and begin fund transfers, or `cancelled` to permanently cancel the mass payment before processing begins. Only applies to mass payments created with deferred status. Returns the updated mass payment resource with the new status.

Official Dwolla endpoint: POST /mass-payments/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of mass payment to update',
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
    protected const PATH = '/mass-payments/{id}';
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
