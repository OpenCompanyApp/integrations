<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Retrieve CPE dictionary records by cpeNameId UUID.
 */
class NvdCpeByNameId extends AbstractNvdTool
{
    protected const NAME = 'nvd_cpe_by_name_id';
    protected const DESCRIPTION = 'Retrieve NVD CPE dictionary records matching one cpeNameId UUID.';
    protected const METHOD = 'cpeByNameId';
    protected const REQUIRED = ['cpe_name_id'];
    protected const PARAMETERS = [
        'cpe_name_id' => ['type' => 'string', 'required' => true, 'description' => 'CPE name UUID.'],
    ];
}
