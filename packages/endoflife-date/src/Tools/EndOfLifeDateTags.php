<?php

namespace OpenCompany\Integrations\EndOfLifeDate\Tools;

/**
 * List all endoflife.date product tags.
 */
class EndOfLifeDateTags extends AbstractEndOfLifeDateTool
{
    protected const NAME = 'endoflife_date_tags';
    protected const DESCRIPTION = 'List all endoflife.date product tags.';
    protected const METHOD = 'tags';
}
