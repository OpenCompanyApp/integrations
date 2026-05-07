<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query FAERS drug adverse event reports.
 */
class OpenFdaDrugEvent extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_event';
    protected const DESCRIPTION = 'Query the openFDA drug adverse event reports endpoint.';
    protected const ENDPOINT = 'drug/event';
}
