<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query drug structured product labeling records.
 */
class OpenFdaDrugLabel extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_drug_label';
    protected const DESCRIPTION = 'Query the openFDA drug product labeling endpoint.';
    protected const ENDPOINT = 'drug/label';
}
