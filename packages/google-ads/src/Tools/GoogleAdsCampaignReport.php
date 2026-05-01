<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Run a campaign performance report.
 */
class GoogleAdsCampaignReport extends GoogleAdsTool
{
    protected const ACTION = 'campaign_report';
    protected const NAME = 'google_ads_campaign_report';
    protected const DESCRIPTION = 'Run a normalized campaign performance report with metrics, costs, conversions, and dates.';
}
