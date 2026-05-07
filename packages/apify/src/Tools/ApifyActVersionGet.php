<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Get version.
 *
 * Executes the official Apify API operation act_version_get.
 */
class ApifyActVersionGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_act_version_get';
}
