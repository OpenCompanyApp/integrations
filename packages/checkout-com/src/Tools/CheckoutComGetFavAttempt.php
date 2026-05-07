<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a face authentication attempt.
 *
 * Maps to the official Checkout.com endpoint GET /face-authentications/{face_authentication_id}/attempts/{attempt_id}.
 */
class CheckoutComGetFavAttempt extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_fav_attempt';
    protected const DESCRIPTION = 'Beta Get the details of a specific attempt for a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: GET /face-authentications/{face_authentication_id}/attempts/{attempt_id}.';
    protected const PARAMETERS = [
        'face_authentication_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The face authentication\'s unique identifier.',
        ],
        'attempt_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The attempt\'s unique identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/face-authentications/{face_authentication_id}/attempts/{attempt_id}';
    protected const PATH_PARAMS = [
        'face_authentication_id' => 'face_authentication_id',
        'attempt_id' => 'attempt_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
