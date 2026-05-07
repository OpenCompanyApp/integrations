<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device premarket approval records.
 */
class OpenFdaDevicePma extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_pma';
    protected const DESCRIPTION = 'Query the openFDA device PMA endpoint.';
    protected const ENDPOINT = 'device/pma';
}
