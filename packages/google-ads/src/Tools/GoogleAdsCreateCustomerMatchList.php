<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Create a Customer Match user list.
 */
class GoogleAdsCreateCustomerMatchList extends GoogleAdsTool
{
    protected const ACTION = 'create_customer_match_list';
    protected const NAME = 'google_ads_create_customer_match_list';
    protected const DESCRIPTION = 'Create a CRM-based Customer Match user list for first-party audience uploads.';
}
