<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create a Google Ads campaign budget.
 */
class GoogleAdsCreateCampaignBudget extends GoogleAdsTool
{
    protected const ACTION = 'create_campaign_budget';
    protected const NAME = 'google_ads_create_campaign_budget';
    protected const DESCRIPTION = 'Create a campaign budget with normal currency or micros input.';
}
