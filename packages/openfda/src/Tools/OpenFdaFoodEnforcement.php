<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query food recall enforcement reports.
 */
class OpenFdaFoodEnforcement extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_food_enforcement';
    protected const DESCRIPTION = 'Query the openFDA food enforcement endpoint.';
    protected const ENDPOINT = 'food/enforcement';
}
