<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Delete secret.
 *
 * Maps to the official Checkout.com endpoint DELETE /forward/secrets/{name}.
 */
class CheckoutComDeleteSecret extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_secret';
    protected const DESCRIPTION = 'Permanently delete a secret by name.

Official Checkout.com endpoint: DELETE /forward/secrets/{name}.';
    protected const PARAMETERS = [
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Secret name.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/forward/secrets/{name}';
    protected const PATH_PARAMS = [
        'name' => 'name',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
