<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List Crossref works for a DOI prefix. */
class CrossrefListPrefixWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_prefix_works';
    protected const DESCRIPTION = 'List Crossref works associated with a DOI owner prefix.';
    protected const PATH = 'prefixes/{prefix}/works';
    protected const PATH_PARAMS = ['prefix'];
    protected const PARAMETERS = [
        'prefix' => ['type' => 'string', 'required' => true, 'description' => 'DOI prefix, such as 10.5555.'],
    ];
}
