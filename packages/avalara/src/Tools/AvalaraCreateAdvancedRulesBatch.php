<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new Advanced Rules batch.
 *
 * Executes the official Avalara AvaTax REST API operation CreateAdvancedRulesBatch.
 */
class AvalaraCreateAdvancedRulesBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_advanced_rules_batch';
}