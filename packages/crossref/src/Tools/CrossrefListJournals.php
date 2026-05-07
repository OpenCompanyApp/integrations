<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List journals with Crossref content. */
class CrossrefListJournals extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_journals';
    protected const DESCRIPTION = 'List journals with registered Crossref content.';
    protected const PATH = 'journals';
}
