<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List funders in the Open Funder Registry. */
class CrossrefListFunders extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_funders';
    protected const DESCRIPTION = 'List funders in the Open Funder Registry.';
    protected const PATH = 'funders';
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => false, 'description' => 'Funder search query.'],
    ];
}
