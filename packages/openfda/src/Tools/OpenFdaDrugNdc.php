<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query NDC directory product listing records.
 */
class OpenFdaDrugNdc extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_ndc';
    protected const DESCRIPTION = 'Query the openFDA NDC directory endpoint.';
    protected const ENDPOINT = 'drug/ndc';
}
