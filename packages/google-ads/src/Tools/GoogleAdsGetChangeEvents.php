<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List field-level account changes.
 */
class GoogleAdsGetChangeEvents extends GoogleAdsTool
{
    protected const ACTION = 'get_change_events';
    protected const NAME = 'google_ads_get_change_events';
    protected const DESCRIPTION = 'List field-level recent account changes using change_event.';
}
