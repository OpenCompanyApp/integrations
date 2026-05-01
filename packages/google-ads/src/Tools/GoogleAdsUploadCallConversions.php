<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Upload call conversions.
 */
class GoogleAdsUploadCallConversions extends GoogleAdsTool
{
    protected const ACTION = 'upload_call_conversions';
    protected const NAME = 'google_ads_upload_call_conversions';
    protected const DESCRIPTION = 'Upload offline call conversions through ConversionUploadService.';
}
