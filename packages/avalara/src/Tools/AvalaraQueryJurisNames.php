<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all unique jurisnames based on filter..
 *
 * Executes the official Avalara AvaTax REST API operation QueryJurisNames.
 */
class AvalaraQueryJurisNames extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_juris_names';
}