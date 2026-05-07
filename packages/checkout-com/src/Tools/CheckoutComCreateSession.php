<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Request a session.
 *
 * Maps to the official Checkout.com endpoint POST /sessions.
 */
class CheckoutComCreateSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_session';
    protected const DESCRIPTION = 'Create a payment session to authenticate a cardholder before requesting a payment. Payment sessions can be linked to one or more payments (in the case of recurring and other merchant-initiated payments). The `next_actions` object in the response tells you which actions can be performed next.

Official Checkout.com endpoint: POST /sessions.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sessions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
