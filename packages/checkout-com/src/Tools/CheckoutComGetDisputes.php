<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get disputes.
 *
 * Maps to the official Checkout.com endpoint GET /disputes.
 */
class CheckoutComGetDisputes extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_disputes';
    protected const DESCRIPTION = 'Returns a list of all disputes against your business. The results will be returned in reverse chronological order, showing the last modified dispute (for example, where you\'ve recently added a piece of evidence) first. You can use the optional parameters below to skip or limit results.

Official Checkout.com endpoint: GET /disputes.';
    protected const PARAMETERS = [
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The numbers of results to return',
        ],
        'skip' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The number of results to skip',
        ],
        'from' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The date and time from which to filter disputes, based on the dispute\'s `last_update` field',
        ],
        'to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The date and time until which to filter disputes, based on the dispute\'s `last_update` field',
        ],
        'id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique identifier of the dispute',
        ],
        'entity_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated client entities. This works like a logical *OR* operator',
        ],
        'sub_entity_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated sub-entities. This works like a logical *OR* operator',
        ],
        'processing_channel_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated processing channels. This works like a logical *OR* operator.',
        ],
        'segment_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated segments. This works like a logical *OR* operator.',
        ],
        'statuses' => [
            'type' => 'string',
            'required' => false,
            'description' => 'One or more comma-separated statuses. This works like a logical *OR* operator',
        ],
        'payment_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The unique identifier of the payment',
        ],
        'payment_reference' => [
            'type' => 'string',
            'required' => false,
            'description' => 'An optional reference (such as an order ID) that you can use later to identify the payment. Previously known as `TrackId`',
        ],
        'payment_arn' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The acquirer reference number (ARN) that you can use to query the issuing bank',
        ],
        'payment_mcc' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The merchant category code (MCC) of the payment (ISO 18245)',
        ],
        'this_channel_only' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'If `true`, only returns disputes of the specific channel that the secret key is associated with. Otherwise, returns all disputes for that business',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/disputes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'skip' => 'skip',
        'from' => 'from',
        'to' => 'to',
        'id' => 'id',
        'entity_ids' => 'entity_ids',
        'sub_entity_ids' => 'sub_entity_ids',
        'processing_channel_ids' => 'processing_channel_ids',
        'segment_ids' => 'segment_ids',
        'statuses' => 'statuses',
        'payment_id' => 'payment_id',
        'payment_reference' => 'payment_reference',
        'payment_arn' => 'payment_arn',
        'payment_mcc' => 'payment_mcc',
        'this_channel_only' => 'this_channel_only',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
