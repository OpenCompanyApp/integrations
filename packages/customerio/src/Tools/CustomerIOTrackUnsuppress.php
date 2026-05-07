<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Unsuppressing a profile allows you to add the customer back to Customer.io.
 */
class CustomerIOTrackUnsuppress extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_track_unsuppress';
}
