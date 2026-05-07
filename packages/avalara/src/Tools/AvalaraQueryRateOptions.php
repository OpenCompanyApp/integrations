<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all RateOptions..
 *
 * Executes the official Avalara AvaTax REST API operation QueryRateOptions.
 */
class AvalaraQueryRateOptions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_rate_options';
}