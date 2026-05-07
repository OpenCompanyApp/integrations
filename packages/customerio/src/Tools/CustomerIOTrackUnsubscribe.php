<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * This endpoint lets you set a global unsubscribed status outside of the subscription pathways native to Customer.io.
 */
class CustomerIOTrackUnsubscribe extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_track_unsubscribe';
}
