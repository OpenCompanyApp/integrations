<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all AvaFileForms.
 *
 * Executes the official Avalara AvaTax REST API operation QueryAvaFileForms.
 */
class AvalaraQueryAvaFileForms extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_ava_file_forms';
}