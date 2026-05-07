<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query MAUDE medical device adverse event reports.
 */
class OpenFdaDeviceEvent extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_event';
    protected const DESCRIPTION = 'Query the openFDA device adverse event endpoint.';
    protected const ENDPOINT = 'device/event';
}
