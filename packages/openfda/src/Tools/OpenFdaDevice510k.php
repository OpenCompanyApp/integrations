<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device 510(k) clearance records.
 */
class OpenFdaDevice510k extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_510k';
    protected const DESCRIPTION = 'Query the openFDA device 510(k) clearances endpoint.';
    protected const ENDPOINT = 'device/510k';
}
