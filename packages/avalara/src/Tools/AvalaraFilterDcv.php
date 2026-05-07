<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get domain control verifications by logged in user/domain name..
 *
 * Executes the official Avalara AvaTax REST API operation FilterDcv.
 */
class AvalaraFilterDcv extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_filter_dcv';
}