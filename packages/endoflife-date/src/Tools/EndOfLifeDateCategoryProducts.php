<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List product summaries in a category.
 */
class EndOfLifeDateCategoryProducts extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_category_products';
    protected const DESCRIPTION = 'List endoflife.date product summaries for a category.';
    protected const METHOD = 'categoryProducts';
    protected const REQUIRED = ['category'];
    protected const PARAMETERS = [
        'category' => ['type' => 'string', 'required' => true, 'description' => 'Category name, such as os, lang, framework, database, server-app, service, app, or device.'],
    ];
}
