<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * List secrets.
 *
 * Maps to the official Checkout.com endpoint GET /forward/secrets.
 */
class CheckoutComListSecrets extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_list_secrets';
    protected const DESCRIPTION = 'Returns metadata for secrets scoped for client_id.

Official Checkout.com endpoint: GET /forward/secrets.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/forward/secrets';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
