<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query medical device registration and listing records.
 */
class OpenFdaDeviceRegistrationListing extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_device_registrationlisting';
    protected const DESCRIPTION = 'Query the openFDA device registration listing endpoint.';
    protected const ENDPOINT = 'device/registrationlisting';
}
