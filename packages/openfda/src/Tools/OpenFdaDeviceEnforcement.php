<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device enforcement reports.
 */
class OpenFdaDeviceEnforcement extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_enforcement';
    protected const DESCRIPTION = 'Query the openFDA device enforcement reports endpoint.';
    protected const ENDPOINT = 'device/enforcement';
}
