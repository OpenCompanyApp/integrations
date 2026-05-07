<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Anonymize an identity verification.
 *
 * Maps to the official Checkout.com endpoint POST /identity-verifications/{identity_verification_id}/anonymize.
 */
class CheckoutComAnonymizeIdentityVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_anonymize_identity_verification';
    protected const DESCRIPTION = 'Beta Remove the personal data in an [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities).

Official Checkout.com endpoint: POST /identity-verifications/{identity_verification_id}/anonymize.';
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
    protected const PATH = '/identity-verifications/{identity_verification_id}/anonymize';
    protected const PATH_PARAMS = [
        'identity_verification_id' => 'identity_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
