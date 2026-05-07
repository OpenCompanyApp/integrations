<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List inboxes accessible by a Front teammate.
 */
class FrontListTeammateInboxes extends AbstractFrontTool
{
    protected const NAME = 'front_list_teammate_inboxes';
    protected const DESCRIPTION = 'List inboxes for a Front teammate.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}/inboxes';
    protected const REQUIRED = ['teammate_id'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
    ];
}
