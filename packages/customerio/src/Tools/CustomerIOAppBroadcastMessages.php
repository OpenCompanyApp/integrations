<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns information about the deliveries (instances of messages sent to individual people) sent from an API-triggered broadcast.
 */
class CustomerIOAppBroadcastMessages extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_broadcast_messages';
}
