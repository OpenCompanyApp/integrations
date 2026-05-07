<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * This endpoint helps you report metrics from channels that aren't native to Customer.io or don't rely on our SDKs.
 */
class CustomerIOTrackMetrics extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_track_metrics';
}
