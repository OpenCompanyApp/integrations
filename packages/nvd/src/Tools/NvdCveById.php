<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Retrieve one CVE record by CVE ID.
 */
class NvdCveById extends AbstractNvdTool
{
    protected const NAME = 'nvd_cve_by_id';
    protected const DESCRIPTION = 'Retrieve NVD CVE records matching one CVE identifier.';
    protected const METHOD = 'cveById';
    protected const REQUIRED = ['cve_id'];
    protected const PARAMETERS = [
        'cve_id' => ['type' => 'string', 'required' => true, 'description' => 'CVE identifier such as CVE-2024-12345.'],
    ];
}
