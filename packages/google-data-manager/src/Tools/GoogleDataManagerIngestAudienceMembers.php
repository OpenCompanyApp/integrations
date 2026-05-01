<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Ingest audience member resources.
 */
class GoogleDataManagerIngestAudienceMembers extends GoogleDataManagerTool
{
    protected const ACTION = 'ingest_audience_members';
    protected const NAME = 'google_data_manager_ingest_audience_members';
    protected const DESCRIPTION = 'Upload AudienceMember resources to Google advertising destinations.';
}
