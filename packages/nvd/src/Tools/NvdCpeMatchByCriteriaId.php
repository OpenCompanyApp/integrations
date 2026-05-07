<?php

namespace OpenCompany\Integrations\Nvd\Tools;

/**
 * Retrieve CPE match criteria records by matchCriteriaId UUID.
 */
class NvdCpeMatchByCriteriaId extends AbstractNvdTool
{
    protected const NAME = 'nvd_cpe_match_by_criteria_id';
    protected const DESCRIPTION = 'Retrieve NVD CPE match criteria records matching one matchCriteriaId UUID.';
    protected const METHOD = 'cpeMatchByCriteriaId';
    protected const REQUIRED = ['match_criteria_id'];
    protected const PARAMETERS = [
        'match_criteria_id' => ['type' => 'string', 'required' => true, 'description' => 'CPE match criteria UUID.'],
    ];
}
