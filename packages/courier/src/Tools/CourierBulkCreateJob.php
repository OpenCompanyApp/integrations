<?php

namespace OpenCompany\Integrations\Courier\Tools;

/**
 * Creates a new bulk job for sending messages to multiple recipients.
 */
class CourierBulkCreateJob extends AbstractCourierOperationTool
{
    protected const OPERATION = 'courier_bulk_create_job';
}
