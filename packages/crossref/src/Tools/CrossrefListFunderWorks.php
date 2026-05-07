<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List works associated with a funder. */
class CrossrefListFunderWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_funder_works';
    protected const DESCRIPTION = 'List Crossref works associated with a funder ID.';
    protected const PATH = 'funders/{id}/works';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Funder ID.'],
    ];
}
