<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Execute a raw Google Data Manager API request.
 */
class GoogleDataManagerRawRequest extends GoogleDataManagerTool
{
    protected const ACTION = 'raw_request';
    protected const NAME = 'google_data_manager_raw_request';
    protected const DESCRIPTION = 'Execute a low-level Google Data Manager API request for advanced coverage.';
}
