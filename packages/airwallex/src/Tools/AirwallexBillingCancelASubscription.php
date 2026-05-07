<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Subscriptions > Cancel a Subscription.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/subscriptions/{subscription_id}/cancel.
 */
class AirwallexBillingCancelASubscription extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_cancel_a_subscription';
    protected const DESCRIPTION = 'Billing > Subscriptions > Cancel a Subscription.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/subscriptions/{subscription_id}/cancel.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `subscription_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/subscriptions/{subscription_id}/cancel';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
