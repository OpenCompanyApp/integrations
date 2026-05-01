<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Invite a user to a Google Ads account.
 */
class GoogleAdsInviteUser extends GoogleAdsTool
{
    protected const ACTION = 'invite_user';
    protected const NAME = 'google_ads_invite_user';
    protected const DESCRIPTION = 'Invite a user to a Google Ads customer account with a chosen access role.';
}
