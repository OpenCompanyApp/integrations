<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List Google Ads customers directly accessible to the OAuth user.
 */
class GoogleAdsListAccessibleCustomers extends GoogleAdsTool
{
    protected const ACTION = 'list_accessible_customers';
    protected const NAME = 'google_ads_list_accessible_customers';
    protected const DESCRIPTION = 'List Google Ads customers directly accessible to the authenticated OAuth user.';
}
