<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a face authentication.
 *
 * Maps to the official Checkout.com endpoint POST /face-authentications.
 */
class CheckoutComCreateFaceAuthentication extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_face_authentication';
    protected const DESCRIPTION = 'Create a face authentication

Official Checkout.com endpoint: POST /face-authentications.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/face-authentications';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
