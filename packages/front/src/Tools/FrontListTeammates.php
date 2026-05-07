<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List teammates in the Front company.
 */
class FrontListTeammates extends AbstractFrontTool
{
    protected const NAME = 'front_list_teammates';
    protected const DESCRIPTION = 'List teammates in the Front company.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates';
    protected const PARAMETERS = [];
}
