<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Simulate incrementing an authorization.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/simulate/authorizations/{id}/authorizations.
 */
class CheckoutComSimulateIncrementalAuthorization extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_simulate_incremental_authorization';
    protected const DESCRIPTION = 'Simulate an incremental authorization request for an existing approved transaction. Incremental authorizations increase the total authorized amount of the transaction. For example, adding a restaurant bill to an existing hotel booking.

Official Checkout.com endpoint: POST /issuing/simulate/authorizations/{id}/authorizations.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/simulate/authorizations/{id}/authorizations';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
