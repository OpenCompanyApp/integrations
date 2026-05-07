<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Coupons > Get a Coupon.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/coupons/{coupon_id}.
 */
class AirwallexBillingGetACoupon extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_a_coupon';
    protected const DESCRIPTION = 'Billing > Coupons > Get a Coupon.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/coupons/{coupon_id}.';
    protected const PARAMETERS = [
        'coupon_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `coupon_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/coupons/{coupon_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'coupon_id' => 'coupon_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
