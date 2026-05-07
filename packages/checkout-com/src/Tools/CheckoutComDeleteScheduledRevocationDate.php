<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Delete scheduled revocation.
 *
 * Maps to the official Checkout.com endpoint DELETE /issuing/cards/{cardId}/schedule-revocation.
 */
class CheckoutComDeleteScheduledRevocationDate extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_scheduled_revocation_date';
    protected const DESCRIPTION = 'Delete a card\'s scheduled revocation.

Official Checkout.com endpoint: DELETE /issuing/cards/{cardId}/schedule-revocation.';
    protected const PARAMETERS = [
        'card_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'cardId',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/issuing/cards/{cardId}/schedule-revocation';
    protected const PATH_PARAMS = [
        'cardId' => 'card_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
