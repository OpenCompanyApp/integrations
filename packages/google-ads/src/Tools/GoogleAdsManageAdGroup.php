<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create or manage ad groups.
 */
class GoogleAdsManageAdGroup extends GoogleAdsTool
{
    protected const ACTION = 'manage_ad_group';
    protected const NAME = 'google_ads_manage_ad_group';
    protected const DESCRIPTION = 'Create, update, pause, enable, or remove Google Ads ad groups.';
}
