<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query FDA drug shortage records.
 */
class OpenFdaDrugShortages extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_shortages';
    protected const DESCRIPTION = 'Query the openFDA drug shortages endpoint.';
    protected const ENDPOINT = 'drug/shortages';
}
