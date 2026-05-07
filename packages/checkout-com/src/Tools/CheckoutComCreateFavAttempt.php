<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a face authentication attempt.
 *
 * Maps to the official Checkout.com endpoint POST /face-authentications/{face_authentication_id}/attempts.
 */
class CheckoutComCreateFavAttempt extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_fav_attempt';
    protected const DESCRIPTION = 'Create a face authentication attempt

Official Checkout.com endpoint: POST /face-authentications/{face_authentication_id}/attempts.';
    protected const PARAMETERS = [
        'face_authentication_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The face authentication\'s unique identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
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
