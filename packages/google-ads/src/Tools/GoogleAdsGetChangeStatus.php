<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List changed resources for sync workflows.
 */
class GoogleAdsGetChangeStatus extends GoogleAdsTool
{
    protected const ACTION = 'get_change_status';
    protected const NAME = 'google_ads_get_change_status';
    protected const DESCRIPTION = 'List changed resources using change_status for incremental sync workflows.';
}
