<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Execute a raw Google Ads API request.
 */
class GoogleAdsRawRequest extends GoogleAdsTool
{
    protected const ACTION = 'raw_request';
    protected const NAME = 'google_ads_raw_request';
    protected const DESCRIPTION = 'Execute a low-level versioned Google Ads API request for advanced coverage.';
}
