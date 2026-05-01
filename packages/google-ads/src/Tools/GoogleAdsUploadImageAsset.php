<?php

namespace OpenCompany\Integrations\GoogleAds\Tools;

/**
 * Upload an image asset.
 */
class GoogleAdsUploadImageAsset extends GoogleAdsTool
{
    protected const ACTION = 'upload_image_asset';
    protected const NAME = 'google_ads_upload_image_asset';
    protected const DESCRIPTION = 'Create an image asset from base64-encoded image bytes.';
}
