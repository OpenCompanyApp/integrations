<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List Crossref works for a journal. */
class CrossrefListJournalWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_journal_works';
    protected const DESCRIPTION = 'List Crossref works in a journal by ISSN.';
    protected const PATH = 'journals/{issn}/works';
    protected const PATH_PARAMS = ['issn'];
    protected const PARAMETERS = [
        'issn' => ['type' => 'string', 'required' => true, 'description' => 'Journal ISSN.'],
    ];
}
