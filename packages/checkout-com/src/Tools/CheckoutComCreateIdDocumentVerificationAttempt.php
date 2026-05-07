<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an ID document verification attempt.
 *
 * Maps to the official Checkout.com endpoint POST /id-document-verifications/{id_document_verification_id}/attempts.
 */
class CheckoutComCreateIdDocumentVerificationAttempt extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_id_document_verification_attempt';
    protected const DESCRIPTION = 'Create an ID document verification attempt

Official Checkout.com endpoint: POST /id-document-verifications/{id_document_verification_id}/attempts.';
    protected const PARAMETERS = [
        'id_document_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID document verification\'s unique identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/id-document-verifications/{id_document_verification_id}/attempts';
    protected const PATH_PARAMS = [
        'id_document_verification_id' => 'id_document_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
