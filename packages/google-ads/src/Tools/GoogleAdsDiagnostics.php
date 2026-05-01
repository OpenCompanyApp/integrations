<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Show safe Google Ads configuration diagnostics.
 */
class GoogleAdsDiagnostics extends GoogleAdsTool
{
    protected const ACTION = 'diagnostics';
    protected const NAME = 'google_ads_diagnostics';
    protected const DESCRIPTION = 'Show safe Google Ads configuration diagnostics without exposing secrets.';
}
