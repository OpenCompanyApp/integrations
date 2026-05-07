<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * Retrieve one product and all known release cycles.
 */
class EndOfLifeDateProduct extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_product';
    protected const DESCRIPTION = 'Retrieve one endoflife.date product, including identifiers, links, labels, and all release cycles.';
    protected const METHOD = 'product';
    protected const REQUIRED = ['product'];
    protected const PARAMETERS = [
        'product' => ['type' => 'string', 'required' => true, 'description' => 'Product slug or alias, such as ubuntu, nodejs, php, or kubernetes.'],
    ];
}
