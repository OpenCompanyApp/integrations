<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an applicant.
 *
 * Maps to the official Checkout.com endpoint POST /applicants.
 */
class CheckoutComCreateApplicant extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_applicant';
    protected const DESCRIPTION = 'Create a profile for an [Identities applicant](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: POST /applicants.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/applicants';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
