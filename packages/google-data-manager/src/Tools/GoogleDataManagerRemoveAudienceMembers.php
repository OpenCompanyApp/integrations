<?php

namespace OpenCompany\Integrations\GoogleDataManager\Tools;

/**
 * Remove audience member resources.
 */
class GoogleDataManagerRemoveAudienceMembers extends GoogleDataManagerTool
{
    protected const ACTION = 'remove_audience_members';
    protected const NAME = 'google_data_manager_remove_audience_members';
    protected const DESCRIPTION = 'Remove AudienceMember resources from Google advertising destinations.';
}
