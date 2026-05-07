<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an ID document verification.
 *
 * Maps to the official Checkout.com endpoint POST /id-document-verifications.
 */
class CheckoutComCreateIdDocumentVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_id_document_verification';
    protected const DESCRIPTION = 'Beta Create an [ID document verification](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents) for an applicant. Ensure you use your ID Document Verification [configuration ID](https://www.checkout.com/docs/business-operations/manage-identities/verify-id-documents#Configuration).

Official Checkout.com endpoint: POST /id-document-verifications.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/id-document-verifications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
