<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Retrieve one OSV advisory from deps.dev.
 */
class DepsDevAdvisory extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_advisory';
    protected const DESCRIPTION = 'Retrieve advisory metadata by OSV, GHSA, or CVE advisory ID from deps.dev.';
    protected const METHOD = 'advisory';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Advisory ID such as GHSA-2qrg-x229-3v8q.'],
    ];
}
