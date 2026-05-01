<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create a complete Search campaign.
 */
class GoogleAdsCreateSearchCampaign extends GoogleAdsTool
{
    protected const ACTION = 'create_search_campaign';
    protected const NAME = 'google_ads_create_search_campaign';
    protected const DESCRIPTION = 'Create a complete paused Search campaign with budget, ad group, keywords, targeting, and responsive search ad.';
}
