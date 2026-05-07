<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get an applicant.
 *
 * Maps to the official Checkout.com endpoint GET /applicants/{applicant_id}.
 */
class CheckoutComRetrieveApplicant extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_retrieve_applicant';
    protected const DESCRIPTION = 'Get the details of an [applicant profile](https://www.checkout.com/docs/business-operations/manage-identities/manage-applicants).

Official Checkout.com endpoint: GET /applicants/{applicant_id}.';
    protected const PARAMETERS = [
        'applicant_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The applicant profile\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
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
