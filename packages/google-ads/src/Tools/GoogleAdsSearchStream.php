<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Execute a streaming GAQL search request.
 */
class GoogleAdsSearchStream extends GoogleAdsTool
{
    protected const ACTION = 'search_stream';
    protected const NAME = 'google_ads_search_stream';
    protected const DESCRIPTION = 'Run a streaming Google Ads Query Language report for larger result sets.';
}
