<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List Attio lists available to the access token. */
class AttioListLists extends AbstractAttioTool
{
    protected const NAME = 'attio_list_lists';
    protected const DESCRIPTION = 'List all Attio lists that the access token can access.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/lists';
    protected const PARAMETERS = [];
}
