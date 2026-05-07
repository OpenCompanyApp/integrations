<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a face authentication.
 *
 * Maps to the official Checkout.com endpoint GET /face-authentications/{face_authentication_id}.
 */
class CheckoutComRetrieveFaceAuthentication extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_retrieve_face_authentication';
    protected const DESCRIPTION = 'Beta Get the details of a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}.';
    protected const PARAMETERS = [
        'face_authentication_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The face authentication\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/face-authentications/{face_authentication_id}';
    protected const PATH_PARAMS = [
        'face_authentication_id' => 'face_authentication_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
