<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List product summaries with a tag.
 */
class EndOfLifeDateTagProducts extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_tag_products';
    protected const DESCRIPTION = 'List endoflife.date product summaries for a tag.';
    protected const METHOD = 'tagProducts';
    protected const REQUIRED = ['tag'];
    protected const PARAMETERS = [
        'tag' => ['type' => 'string', 'required' => true, 'description' => 'Tag name, such as linux-distribution, database, cncf, microsoft, or java-runtime.'],
    ];
}
