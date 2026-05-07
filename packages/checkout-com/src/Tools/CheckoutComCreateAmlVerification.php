<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an AML screening.
 *
 * Maps to the official Checkout.com endpoint POST /aml-verifications.
 */
class CheckoutComCreateAmlVerification extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_aml_verification';
    protected const DESCRIPTION = 'Beta Create an [AML screening](https://www.checkout.com/docs/business-operations/manage-identities/screen-aml-databases). If the request is successful, you receive a `201 Created` response with the AML screening resource.

Official Checkout.com endpoint: POST /aml-verifications.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/aml-verifications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
