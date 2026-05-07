<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve StateConfig information.
 *
 * Executes the official Avalara AvaTax REST API operation QueryStateConfig.
 */
class AvalaraQueryStateConfig extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_state_config';
}