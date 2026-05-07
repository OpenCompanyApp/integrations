<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query drug recall enforcement reports.
 */
class OpenFdaDrugEnforcement extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_enforcement';
    protected const DESCRIPTION = 'Query the openFDA drug enforcement reports endpoint.';
    protected const ENDPOINT = 'drug/enforcement';
}
