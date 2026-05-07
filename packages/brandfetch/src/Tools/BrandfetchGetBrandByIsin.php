<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data by explicit ISIN route.
 */
class BrandfetchGetBrandByIsin extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_brand_by_isin';
    protected const TOOL_DESCRIPTION = 'Get brand data using the explicit ISIN route.';
    protected const PARAMETERS = [
        'isin' => ['type' => 'string', 'required' => true, 'description' => 'ISIN identifier, for example US6541061031.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->getBrandByType('isin', (string) $this->required($args, 'isin'));
    }
}
