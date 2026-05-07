<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List economic nexus threshold statuses for a company.
 *
 * Executes the official Avalara AvaTax REST API operation GetEcoNexusThresholdStatuses.
 */
class AvalaraGetEcoNexusThresholdStatuses extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_eco_nexus_threshold_statuses';
}