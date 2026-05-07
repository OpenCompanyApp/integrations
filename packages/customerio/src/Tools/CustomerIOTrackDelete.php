<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Deleting a customer removes them, and all of their information, from Customer.io.
 */
class CustomerIOTrackDelete extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_track_delete';
}
