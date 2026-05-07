<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query GUDID unique device identifier records.
 */
class OpenFdaDeviceUdi extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_udi';
    protected const DESCRIPTION = 'Query the openFDA device UDI endpoint.';
    protected const ENDPOINT = 'device/udi';
}
