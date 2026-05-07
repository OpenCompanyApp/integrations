<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an identity verification attempt.
 *
 * Maps to the official Checkout.com endpoint POST /identity-verifications/{identity_verification_id}/attempts.
 */
class CheckoutComCreateAttempt extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_attempt';
    protected const DESCRIPTION = 'Create an identity verification attempt

Official Checkout.com endpoint: POST /identity-verifications/{identity_verification_id}/attempts.';
    protected const PARAMETERS = [
        'identity_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The identity verification\'s unique identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/identity-verifications/{identity_verification_id}/attempts';
    protected const PATH_PARAMS = [
        'identity_verification_id' => 'identity_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
