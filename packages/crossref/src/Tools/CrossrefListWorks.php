<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List Crossref works. */
class CrossrefListWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_works';
    protected const DESCRIPTION = 'List, search, filter, facet, sample, or page Crossref works.';
    protected const PATH = 'works';
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => false, 'description' => 'Bibliographic search query.'],
        'query.title' => ['type' => 'string', 'required' => false, 'description' => 'Title search query.'],
        'query.author' => ['type' => 'string', 'required' => false, 'description' => 'Author search query.'],
        'query.bibliographic' => ['type' => 'string', 'required' => false, 'description' => 'Bibliographic search query.'],
    ];
}
