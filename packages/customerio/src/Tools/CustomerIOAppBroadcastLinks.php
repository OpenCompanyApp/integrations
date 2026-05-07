<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns metrics for link clicks within a broadcast, both in total and in series periods (days, weeks, etc).
 */
class CustomerIOAppBroadcastLinks extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_broadcast_links';
}
