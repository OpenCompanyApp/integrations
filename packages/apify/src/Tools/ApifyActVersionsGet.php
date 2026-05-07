<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of versions.
 *
 * Executes the official Apify API operation act_versions_get.
 */
class ApifyActVersionsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_versions_get';
}
