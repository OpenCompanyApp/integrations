<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * If your broadcast produced validation errors, this endpoint can help you better understand what went wrong.
 */
class CustomerIOAppBroadcastErrors extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_broadcast_errors';
}
