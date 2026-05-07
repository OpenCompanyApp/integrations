<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update an applicant.
 *
 * Maps to the official Checkout.com endpoint PATCH /applicants/{applicant_id}.
 */
class CheckoutComUpdateApplicant extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_applicant';
    protected const DESCRIPTION = 'Update the details of an [applicant profile](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: PATCH /applicants/{applicant_id}.';
    protected const PARAMETERS = [
        'applicant_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The applicant profile\'s unique identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/applicants/{applicant_id}';
    protected const PATH_PARAMS = [
        'applicant_id' => 'applicant_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
