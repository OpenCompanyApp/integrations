<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Remove lines from an existing unlocked transaction.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteLines.
 */
class AvalaraDeleteLines extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_lines';
}