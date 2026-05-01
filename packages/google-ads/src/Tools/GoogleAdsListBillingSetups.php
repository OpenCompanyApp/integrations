<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * List account billing setup resources.
 */
class GoogleAdsListBillingSetups extends GoogleAdsTool
{
    protected const ACTION = 'list_billing_setups';
    protected const NAME = 'google_ads_list_billing_setups';
    protected const DESCRIPTION = 'List billing setup resources and payment account metadata.';
}
