<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List managed customer clients under a Google Ads account.
 */
class GoogleAdsListCustomerClients extends GoogleAdsTool
{
    protected const ACTION = 'list_customer_clients';
    protected const NAME = 'google_ads_list_customer_clients';
    protected const DESCRIPTION = 'List managed client accounts under a manager or customer account.';
}
