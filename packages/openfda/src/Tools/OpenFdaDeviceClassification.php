<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device classification records.
 */
class OpenFdaDeviceClassification extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_classification';
    protected const DESCRIPTION = 'Query the openFDA device classification endpoint.';
    protected const ENDPOINT = 'device/classification';
}
