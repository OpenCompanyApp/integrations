<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get face authentication attempts.
 *
 * Maps to the official Checkout.com endpoint GET /face-authentications/{face_authentication_id}/attempts.
 */
class CheckoutComListFavAttempts extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_list_fav_attempts';
    protected const DESCRIPTION = 'Beta Get the details of all attempts for a specific [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}/attempts.';
    protected const PARAMETERS = [
        'face_authentication_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The face authentication\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/face-authentications/{face_authentication_id}/attempts';
    protected const PATH_PARAMS = [
        'face_authentication_id' => 'face_authentication_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
