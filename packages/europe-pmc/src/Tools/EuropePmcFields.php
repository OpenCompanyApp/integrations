<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * List Europe PMC indexed search fields.
 */
class EuropePmcFields extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_fields';
    protected const DESCRIPTION = 'List Europe PMC indexed search fields and the datasets where they can be used.';
    protected const PATH = 'fields';
    protected const DEFAULTS = ['format' => 'json'];
}
