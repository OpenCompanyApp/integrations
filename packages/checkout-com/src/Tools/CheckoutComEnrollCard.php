<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Enroll a card in 3DS.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/3ds-enrollment.
 */
class CheckoutComEnrollCard extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_enroll_card';
    protected const DESCRIPTION = 'Enrolls a card in 3D Secure (3DS). Additional information is requested from the cardholder through a 3DS challenge when performing a transaction. Two-factor authentication (2FA) is supported. For maximum security, we recommend using a combination of a one-time password (OTP) sent via SMS, along with a password or question and answer security pair.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/3ds-enrollment.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/cards/{cardId}/3ds-enrollment';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
