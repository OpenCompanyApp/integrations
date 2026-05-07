<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve public Europe PMC service metrics.
 */
class EuropePmcMetrics extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_metrics';
    protected const DESCRIPTION = 'Retrieve public Europe PMC metrics.';
    protected const PATH = 'metrics';
    protected const DEFAULTS = ['format' => 'json'];
}
