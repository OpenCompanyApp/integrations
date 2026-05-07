<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

/**
 * Get brand data by explicit domain route.
 */
class BrandfetchGetBrandByDomain extends AbstractBrandfetchTool
{
    protected const TOOL_NAME = 'brandfetch_get_brand_by_domain';
    protected const TOOL_DESCRIPTION = 'Get brand data using the explicit domain identifier route.';
    protected const PARAMETERS = [
        'domain' => ['type' => 'string', 'required' => true, 'description' => 'Brand domain, for example nike.com.'],
    ];

    protected function run(array $args): array
    {
        return $this->service->getBrandByType('domain', (string) $this->required($args, 'domain'));
    }
}
