<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query cosmetic adverse event reports.
 */
class OpenFdaCosmeticEvent extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_cosmetic_event';
    protected const DESCRIPTION = 'Query the openFDA cosmetic event endpoint.';
    protected const ENDPOINT = 'cosmetic/event';
}
