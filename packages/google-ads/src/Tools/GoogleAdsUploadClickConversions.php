<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Upload click conversions.
 */
class GoogleAdsUploadClickConversions extends GoogleAdsTool
{
    protected const ACTION = 'upload_click_conversions';
    protected const NAME = 'google_ads_upload_click_conversions';
    protected const DESCRIPTION = 'Upload offline or enhanced lead click conversions through ConversionUploadService.';
}
