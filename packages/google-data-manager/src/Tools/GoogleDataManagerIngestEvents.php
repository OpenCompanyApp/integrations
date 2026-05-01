<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Ingest conversion event resources.
 */
class GoogleDataManagerIngestEvents extends GoogleDataManagerTool
{
    protected const ACTION = 'ingest_events';
    protected const NAME = 'google_data_manager_ingest_events';
    protected const DESCRIPTION = 'Upload conversion Event resources to Google advertising destinations.';
}
