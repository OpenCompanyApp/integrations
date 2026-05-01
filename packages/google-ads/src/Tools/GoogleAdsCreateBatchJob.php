<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create and optionally run a batch job.
 */
class GoogleAdsCreateBatchJob extends GoogleAdsTool
{
    protected const ACTION = 'create_batch_job';
    protected const NAME = 'google_ads_create_batch_job';
    protected const DESCRIPTION = 'Create a Google Ads batch job and optionally append operations and run it.';
}
