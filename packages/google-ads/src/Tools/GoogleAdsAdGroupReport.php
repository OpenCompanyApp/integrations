<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Run an ad group performance report.
 */
class GoogleAdsAdGroupReport extends GoogleAdsTool
{
    protected const ACTION = 'ad_group_report';
    protected const NAME = 'google_ads_ad_group_report';
    protected const DESCRIPTION = 'Run a normalized ad group performance report with campaign context and metrics.';
}
