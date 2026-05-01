<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Execute a paginated GAQL search request.
 */
class GoogleAdsSearch extends GoogleAdsTool
{
    protected const ACTION = 'search';
    protected const NAME = 'google_ads_search';
    protected const DESCRIPTION = 'Run a paginated Google Ads Query Language search request.';
}
