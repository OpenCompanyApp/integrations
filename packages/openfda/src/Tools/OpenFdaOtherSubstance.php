<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query FDA substance records.
 */
class OpenFdaOtherSubstance extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_other_substance';
    protected const DESCRIPTION = 'Query the openFDA substance endpoint.';
    protected const ENDPOINT = 'other/substance';
}
