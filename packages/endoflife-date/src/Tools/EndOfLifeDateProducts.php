<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List all products with summary lifecycle metadata.
 */
class EndOfLifeDateProducts extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_products';
    protected const DESCRIPTION = 'List all products referenced by endoflife.date with summary metadata.';
    protected const METHOD = 'products';
}
