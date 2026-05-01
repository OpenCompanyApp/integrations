<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List campaigns with account-level metadata.
 */
class GoogleAdsListCampaigns extends GoogleAdsTool
{
    protected const ACTION = 'list_campaigns';
    protected const NAME = 'google_ads_list_campaigns';
    protected const DESCRIPTION = 'List campaigns with status, channel, serving state, dates, budget, and optimization score.';
}
