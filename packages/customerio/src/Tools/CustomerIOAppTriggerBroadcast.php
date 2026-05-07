<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Trigger a broadcast (not a newsletter) and optionally provide data to populate liquid placeholders in the message.
 */
class CustomerIOAppTriggerBroadcast extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_trigger_broadcast';
}
