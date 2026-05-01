<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Retrieve an ingestion request status.
 */
class GoogleDataManagerRetrieveRequestStatus extends GoogleDataManagerTool
{
    protected const ACTION = 'retrieve_request_status';
    protected const NAME = 'google_data_manager_retrieve_request_status';
    protected const DESCRIPTION = 'Retrieve Google Data Manager processing status by request ID.';
}
