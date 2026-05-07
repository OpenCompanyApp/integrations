<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get Crossref member details. */
class CrossrefGetMember extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_member';
    protected const DESCRIPTION = 'Get details about a Crossref member by member ID.';
    protected const PATH = 'members/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Crossref member ID.'],
    ];
}
