<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device recall records.
 */
class OpenFdaDeviceRecall extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_recall';
    protected const DESCRIPTION = 'Query the openFDA device recall endpoint.';
    protected const ENDPOINT = 'device/recall';
}
