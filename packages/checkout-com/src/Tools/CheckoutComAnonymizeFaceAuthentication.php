<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Anonymize a face authentication.
 *
 * Maps to the official Checkout.com endpoint POST /face-authentications/{face_authentication_id}/anonymize.
 */
class CheckoutComAnonymizeFaceAuthentication extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_anonymize_face_authentication';
    protected const DESCRIPTION = 'Beta Remove the personal data in a [face authentication](https://www.checkout.com/docs/business-operations/manage-identities/authenticate-with-biometrics).

Official Checkout.com endpoint: POST /face-authentications/{face_authentication_id}/anonymize.';
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
    protected const PATH = '/face-authentications/{face_authentication_id}/anonymize';
    protected const PATH_PARAMS = [
        'face_authentication_id' => 'face_authentication_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
