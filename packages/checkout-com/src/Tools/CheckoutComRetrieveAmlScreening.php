<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get an AML screening.
 *
 * Maps to the official Checkout.com endpoint GET /aml-verifications/{aml_verification_id}.
 */
class CheckoutComRetrieveAmlScreening extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_retrieve_aml_screening';
    protected const DESCRIPTION = 'Get the detailed result of an [AML screening](https://www.checkout.com/docs/business-operations/manage-identities/screen-aml-databases).

Official Checkout.com endpoint: GET /aml-verifications/{aml_verification_id}.';
    protected const PARAMETERS = [
        'aml_verification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The AML screening\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/aml-verifications/{aml_verification_id}';
    protected const PATH_PARAMS = [
        'aml_verification_id' => 'aml_verification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
