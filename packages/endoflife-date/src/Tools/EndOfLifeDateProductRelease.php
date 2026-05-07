<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * Retrieve one product release cycle.
 */
class EndOfLifeDateProductRelease extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_product_release';
    protected const DESCRIPTION = 'Retrieve one endoflife.date product release cycle by product slug and release cycle name.';
    protected const METHOD = 'productRelease';
    protected const REQUIRED = ['product', 'release'];
    protected const PARAMETERS = [
        'product' => ['type' => 'string', 'required' => true, 'description' => 'Product slug or alias, such as ubuntu, nodejs, php, or kubernetes.'],
        'release' => ['type' => 'string', 'required' => true, 'description' => 'Release cycle name, such as 24.04, 22, 8.3, or 1.30.'],
    ];
}
