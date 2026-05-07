<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get payment lists.
 *
 * Maps to the official Checkout.com endpoint GET /payments.
 */
class CheckoutComGetPaymentsList extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_payments_list';
    protected const DESCRIPTION = 'Beta Returns a list of your business\' payments that match the specified reference. Results are returned in reverse chronological order, with the most recent payments shown first. This will only return payments initiated from June 2022 onwards. Payments initiated before this date may return a `404` error code if you attempt to retrieve them.

Official Checkout.com endpoint: GET /payments.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The numbers of results to retrieve',
        ],
        'skip' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of results to skip',
        ],
        'reference' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A reference, such as an order ID, that can be used to identify the payment',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'skip' => 'skip',
        'reference' => 'reference',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
