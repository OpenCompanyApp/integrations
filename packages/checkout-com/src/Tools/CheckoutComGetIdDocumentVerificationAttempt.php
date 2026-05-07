<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get an ID document verification attempt.
 *
 * Maps to the official Checkout.com endpoint GET /id-document-verifications/{id_document_verification_id}/attempts/{attempt_id}.
 */
class CheckoutComGetIdDocumentVerificationAttempt extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_id_document_verification_attempt';
    protected const DESCRIPTION = 'Beta Get the details of a specific attempt for an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}/attempts/{attempt_id}.';
    protected const PARAMETERS = [
        'id_document_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID document verification\'s unique identifier.',
        ],
        'attempt_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The attempt\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/id-document-verifications/{id_document_verification_id}/attempts/{attempt_id}';
    protected const PATH_PARAMS = [
        'id_document_verification_id' => 'id_document_verification_id',
        'attempt_id' => 'attempt_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
