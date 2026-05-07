<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get Crossref funder metadata. */
class CrossrefGetFunder extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_funder';
    protected const DESCRIPTION = 'Get metadata for a funder by Open Funder Registry ID.';
    protected const PATH = 'funders/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Funder ID.'],
    ];
}
