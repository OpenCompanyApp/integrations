<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Handle a notification.
 *
 * Maps to the official GoCardless endpoint POST /customer_notifications/{customer_notification_id}/actions/handle.
 */
class GoCardlessHandleCustomerNotification extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_handle_customer_notification';
    protected const DESCRIPTION = '"Handling" a notification means that you have sent the notification yourself (and don\'t want GoCardless to send it). If the notification has already been actioned, or the deadline to notify has passed, this endpoint will return an `already_actioned` error and you should not take further action. This endpoint takes no additional parameters.

Official GoCardless endpoint: POST /customer_notifications/{customer_notification_id}/actions/handle.';
    protected const PARAMETERS = [
        'customer_notification_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The customer notification id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/customer_notifications/{customer_notification_id}/actions/handle';
    protected const PATH_PARAMS = [
        'customer_notification_id' => 'customer_notification_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
