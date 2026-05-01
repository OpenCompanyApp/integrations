<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Run a Customer Match offline user data job.
 */
class GoogleAdsRunCustomerMatchJob extends GoogleAdsTool
{
    protected const ACTION = 'run_customer_match_job';
    protected const NAME = 'google_ads_run_customer_match_job';
    protected const DESCRIPTION = 'Create, populate, and run an OfflineUserDataJob for Customer Match user uploads.';
}
