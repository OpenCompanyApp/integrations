<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Delete a customer profile and prevent the person's identifier(s) from being re-added to your workspace.
 */
class CustomerIOTrackSuppress extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_track_suppress';
}
