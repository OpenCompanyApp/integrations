<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get Crossref journal details by ISSN. */
class CrossrefGetJournal extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_journal';
    protected const DESCRIPTION = 'Get details of a Crossref journal by ISSN.';
    protected const PATH = 'journals/{issn}';
    protected const PATH_PARAMS = ['issn'];
    protected const PARAMETERS = [
        'issn' => ['type' => 'string', 'required' => true, 'description' => 'Journal ISSN.'],
    ];
}
