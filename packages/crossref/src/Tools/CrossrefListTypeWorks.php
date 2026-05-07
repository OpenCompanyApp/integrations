<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List works for a Crossref work type. */
class CrossrefListTypeWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_type_works';
    protected const DESCRIPTION = 'List Crossref works with the specified work type.';
    protected const PATH = 'types/{id}/works';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Work type ID, such as journal-article.'],
    ];
}
