<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Subscriptions > Retrieve a Subscription.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/subscriptions/{subscription_id}.
 */
class AirwallexBillingRetrieveASubscription extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_retrieve_a_subscription';
    protected const DESCRIPTION = 'Billing > Subscriptions > Retrieve a Subscription.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/subscriptions/{subscription_id}.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `subscription_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/subscriptions/{subscription_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
