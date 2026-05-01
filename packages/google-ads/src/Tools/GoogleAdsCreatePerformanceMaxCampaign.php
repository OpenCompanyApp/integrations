<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create a complete Performance Max campaign.
 */
class GoogleAdsCreatePerformanceMaxCampaign extends GoogleAdsTool
{
    protected const ACTION = 'create_performance_max_campaign';
    protected const NAME = 'google_ads_create_performance_max_campaign';
    protected const DESCRIPTION = 'Create a governed Performance Max campaign with budget, asset group, text assets, existing assets, and targeting.';
}
