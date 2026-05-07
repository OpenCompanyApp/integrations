<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query Unique Ingredient Identifier records.
 */
class OpenFdaOtherUnii extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_other_unii';
    protected const DESCRIPTION = 'Query the openFDA UNII endpoint.';
    protected const ENDPOINT = 'other/unii';
}
