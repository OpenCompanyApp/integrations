<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * Retrieve the latest release cycle for a product.
 */
class EndOfLifeDateLatestRelease extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_latest_release';
    protected const DESCRIPTION = 'Retrieve the latest release cycle information for an endoflife.date product.';
    protected const METHOD = 'latestRelease';
    protected const REQUIRED = ['product'];
    protected const PARAMETERS = [
        'product' => ['type' => 'string', 'required' => true, 'description' => 'Product slug or alias, such as ubuntu, nodejs, php, or kubernetes.'],
    ];
}
