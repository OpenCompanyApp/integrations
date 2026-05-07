<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query openFDA historical document records.
 */
class OpenFdaOtherHistoricalDocument extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_other_historicaldocument';
    protected const DESCRIPTION = 'Query the openFDA historical document endpoint.';
    protected const ENDPOINT = 'other/historicaldocument';
}
