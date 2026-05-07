<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Schedule card revocation.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/cards/{cardId}/schedule-revocation.
 */
class CheckoutComAddScheduledRevocationDate extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_scheduled_revocation_date';
    protected const DESCRIPTION = 'Schedules a card to be revoked at 00:00(UTC) on a specified date.

Official Checkout.com endpoint: POST /issuing/cards/{cardId}/schedule-revocation.';
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
    protected const PATH = '/issuing/cards/{cardId}/schedule-revocation';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
