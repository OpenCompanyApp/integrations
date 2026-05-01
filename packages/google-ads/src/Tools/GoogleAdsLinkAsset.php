<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Link an asset to an account, campaign, ad group, or asset group.
 */
class GoogleAdsLinkAsset extends GoogleAdsTool
{
    protected const ACTION = 'link_asset';
    protected const NAME = 'google_ads_link_asset';
    protected const DESCRIPTION = 'Link an existing asset to a customer, campaign, ad group, or asset group with a field type.';
}
