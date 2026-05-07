<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get ID document verification attempts.
 *
 * Maps to the official Checkout.com endpoint GET /id-document-verifications/{id_document_verification_id}/attempts.
 */
class CheckoutComListAttemptsIdDocumentVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_list_attempts_id_document_verification';
    protected const DESCRIPTION = 'Beta Get the details of all attempts for a specific [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: GET /id-document-verifications/{id_document_verification_id}/attempts.';
    protected const PARAMETERS = [
        'id_document_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID document verification\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
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
