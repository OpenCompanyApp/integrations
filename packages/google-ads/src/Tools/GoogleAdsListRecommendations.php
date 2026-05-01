<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List Google Ads recommendations.
 */
class GoogleAdsListRecommendations extends GoogleAdsTool
{
    protected const ACTION = 'list_recommendations';
    protected const NAME = 'google_ads_list_recommendations';
    protected const DESCRIPTION = 'List optimization recommendations available for the account.';
}
