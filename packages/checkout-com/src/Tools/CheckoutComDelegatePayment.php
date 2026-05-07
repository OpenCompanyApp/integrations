<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a delegated payment token.
 *
 * Maps to the official Checkout.com endpoint POST /agentic_commerce/delegate_payment.
 */
class CheckoutComDelegatePayment extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delegate_payment';
    protected const DESCRIPTION = 'Create a delegated payment token

Official Checkout.com endpoint: POST /agentic_commerce/delegate_payment.';
    protected const PARAMETERS = [
        'signature' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A Base64-encoded HMAC-SHA256 signature used for request body integrity verification. Compute the signature as follows: 1. Concatenate the `Timestamp` header value (as a UTF-8 string) with the raw JSON request body (as a UTF-8 string). 2. Compute the HMAC-SHA25',
        ],
        'timestamp' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The timestamp of the request, in RFC 3339 format (for example, `2026-03-11T10:30:00Z`). The timestamp must be within 5 minutes of the server time. Requests with a timestamp outside this window are rejected with a `401` response.',
        ],
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional idempotency key for safely retrying payment requests',
        ],
        'api_version' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The API version to use for the request. If not specified, the default version (`2026-01-30`) is used.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/agentic_commerce/delegate_payment';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Signature' => 'signature',
        'Timestamp' => 'timestamp',
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
        'API-Version' => 'api_version',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
