<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create or manage campaigns.
 */
class GoogleAdsManageCampaign extends GoogleAdsTool
{
    protected const ACTION = 'manage_campaign';
    protected const NAME = 'google_ads_manage_campaign';
    protected const DESCRIPTION = 'Create, update, pause, enable, or remove Google Ads campaigns.';
}
