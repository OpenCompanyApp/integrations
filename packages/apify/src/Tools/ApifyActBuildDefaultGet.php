<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get default build.
 *
 * Executes the official Apify API operation act_build_default_get.
 */
class ApifyActBuildDefaultGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_build_default_get';
}
