<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of Actors.
 *
 * Executes the official Apify API operation acts_get.
 */
class ApifyActsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_acts_get';
}
