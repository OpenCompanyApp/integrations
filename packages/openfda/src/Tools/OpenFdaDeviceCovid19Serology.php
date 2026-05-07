<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query COVID-19 serology testing evaluation records.
 */
class OpenFdaDeviceCovid19Serology extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_covid19_serology';
    protected const DESCRIPTION = 'Query the openFDA COVID-19 serology testing evaluations endpoint.';
    protected const ENDPOINT = 'device/covid19serology';
}
