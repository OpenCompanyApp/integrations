<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query food adverse event reports.
 */
class OpenFdaFoodEvent extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_food_event';
    protected const DESCRIPTION = 'Query the openFDA food event endpoint.';
    protected const ENDPOINT = 'food/event';
}
