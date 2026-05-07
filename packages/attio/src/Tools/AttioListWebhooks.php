<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** List Attio webhooks. */
class AttioListWebhooks extends AbstractAttioTool
{
    protected const NAME = 'attio_list_webhooks';
    protected const DESCRIPTION = 'List Attio webhooks configured in the workspace.';
    protected const METHOD = 'GET';
    protected const PATH = '/v2/webhooks';
    protected const PARAMETERS = [];
}
