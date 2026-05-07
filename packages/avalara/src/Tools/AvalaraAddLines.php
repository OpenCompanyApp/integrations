<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add lines to an existing unlocked transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AddLines.
 */
class AvalaraAddLines extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_add_lines';
}