<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * After triggering a broadcast you can retrieve the status of that broadcast using a GET of the trigger_id.
 */
class CustomerIOAppBroadcastStatus extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_broadcast_status';
}
