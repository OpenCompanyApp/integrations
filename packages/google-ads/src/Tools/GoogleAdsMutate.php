<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Execute governed mutate operations.
 */
class GoogleAdsMutate extends GoogleAdsTool
{
    protected const ACTION = 'mutate';
    protected const NAME = 'google_ads_mutate';
    protected const DESCRIPTION = 'Run resource-specific or mixed Google Ads mutate operations with confirmation and validation controls.';
}
