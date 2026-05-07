<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Anonymize an ID document verification.
 *
 * Maps to the official Checkout.com endpoint POST /id-document-verifications/{id_document_verification_id}/anonymize.
 */
class CheckoutComAnonymizeIdDocumentVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_anonymize_id_document_verification';
    protected const DESCRIPTION = 'Beta Remove the personal data from an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents).

Official Checkout.com endpoint: POST /id-document-verifications/{id_document_verification_id}/anonymize.';
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
    protected const PATH = '/id-document-verifications/{id_document_verification_id}/anonymize';
    protected const PATH_PARAMS = [
        'id_document_verification_id' => 'id_document_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
