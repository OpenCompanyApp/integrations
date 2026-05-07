<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query National Substance Data Exchange records.
 */
class OpenFdaOtherNsde extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_other_nsde';
    protected const DESCRIPTION = 'Query the openFDA NSDE endpoint.';
    protected const ENDPOINT = 'other/nsde';
}
