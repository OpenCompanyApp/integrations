<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get a Crossref work type. */
class CrossrefGetType extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_type';
    protected const DESCRIPTION = 'Get information about a Crossref work type.';
    protected const PATH = 'types/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Work type ID, such as journal-article.'],
    ];
}
