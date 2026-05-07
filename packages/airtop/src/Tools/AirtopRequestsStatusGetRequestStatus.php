<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Get the status of an asynchronous request.
 *
 * Executes the official Airtop API operation get-request-status.
 */
class AirtopRequestsStatusGetRequestStatus extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_requests_status_get_request_status';
}
