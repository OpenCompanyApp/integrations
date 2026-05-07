<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * Charge events in run.
 *
 * Executes the official Apify API operation PostChargeRun.
 */
class ApifyPostChargeRun extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_post_charge_run';
}
