<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get identity verification attempts.
 *
 * Maps to the official Checkout.com endpoint GET /identity-verifications/{identity_verification_id}/attempts.
 */
class CheckoutComListAttempts extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_list_attempts';
    protected const DESCRIPTION = 'Beta Get all the attempts for a specific [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}/attempts.';
    protected const PARAMETERS = [
        'identity_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The identity verification\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
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
