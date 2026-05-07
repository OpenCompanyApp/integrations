<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query Drugs@FDA application records.
 */
class OpenFdaDrugDrugsFda extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_drugsfda';
    protected const DESCRIPTION = 'Query the openFDA Drugs@FDA endpoint.';
    protected const ENDPOINT = 'drug/drugsfda';
}
