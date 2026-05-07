<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Parse natural language query into structured filters.
 *
 * Executes the official Avalara AvaTax REST API operation AIsearch.
 */
class AvalaraAIsearch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_a_isearch';
}