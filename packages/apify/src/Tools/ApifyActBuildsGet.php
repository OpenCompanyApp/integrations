<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get list of builds.
 *
 * Executes the official Apify API operation act_builds_get.
 */
class ApifyActBuildsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_builds_get';
}
