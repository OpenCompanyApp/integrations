<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an identity verification.
 *
 * Maps to the official Checkout.com endpoint POST /identity-verifications.
 */
class CheckoutComCreateIdentityVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_identity_verification';
    protected const DESCRIPTION = 'Beta Create an [identity verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities) linked to an applicant. If successful, you receive a `201 Created` response with the identity verification resource. Ensure you use your identity verification [configuration ID](https://www.checkout.com/docs/business-operations/manage-identities/verify-identities#Configuration).

Official Checkout.com endpoint: POST /identity-verifications.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/identity-verifications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
