<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a sub-entity's payout schedule.
 *
 * Maps to the official Checkout.com endpoint PUT /accounts/entities/{id}/payout-schedules.
 */
class CheckoutComPutSubEntitysPayoutSchedule extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_put_sub_entitys_payout_schedule';
    protected const DESCRIPTION = 'You can schedule when your sub-entities receive their funds using our Platforms solution. Use this endpoint to update a sub-entity\'s schedule.

Official Checkout.com endpoint: PUT /accounts/entities/{id}/payout-schedules.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/accounts/entities/{id}/payout-schedules';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
