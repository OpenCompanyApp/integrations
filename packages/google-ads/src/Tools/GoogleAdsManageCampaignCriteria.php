<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create or manage campaign criteria.
 */
class GoogleAdsManageCampaignCriteria extends GoogleAdsTool
{
    protected const ACTION = 'manage_campaign_criteria';
    protected const NAME = 'google_ads_manage_campaign_criteria';
    protected const DESCRIPTION = 'Add, update, or remove campaign criteria such as locations, languages, schedules, and negatives.';
}
