<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a period of time.
 */
class CustomerIOAppBroadcastActionMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_broadcast_action_metrics';
}
