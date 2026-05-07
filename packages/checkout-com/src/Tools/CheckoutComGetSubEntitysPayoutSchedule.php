<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Retrieve a sub-entity's payout schedule.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{id}/payout-schedules.
 */
class CheckoutComGetSubEntitysPayoutSchedule extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_sub_entitys_payout_schedule';
    protected const DESCRIPTION = 'You can schedule when your sub-entities receive their funds using our Platforms solution. Use this endpoint to retrieve information about a sub-entity\'s schedule.

Official Checkout.com endpoint: GET /accounts/entities/{id}/payout-schedules.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{id}/payout-schedules';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
