<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get identity verification report.
 *
 * Maps to the official Checkout.com endpoint GET /identity-verifications/{identity_verification_id}/pdf-report.
 */
class CheckoutComPdfIdentityVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_pdf_identity_verification';
    protected const DESCRIPTION = 'Get identity verification report

Official Checkout.com endpoint: GET /identity-verifications/{identity_verification_id}/pdf-report.';
    protected const PARAMETERS = [
        'identity_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The identity verification\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/identity-verifications/{identity_verification_id}/pdf-report';
    protected const PATH_PARAMS = [
        'identity_verification_id' => 'identity_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
