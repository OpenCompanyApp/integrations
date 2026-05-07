<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List all products with full release lifecycle data.
 */
class EndOfLifeDateProductsFull extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_products_full';
    protected const DESCRIPTION = 'List all endoflife.date products with full release lifecycle data. This is a large dump; prefer endoflife_date_products for discovery.';
    protected const METHOD = 'productsFull';
}
