<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List rules owned by a Front teammate.
 */
class FrontListTeammateRules extends AbstractFrontTool
{
    protected const NAME = 'front_list_teammate_rules';
    protected const DESCRIPTION = 'List rules for a Front teammate.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}/rules';
    protected const REQUIRED = ['teammate_id'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
    ];
}
