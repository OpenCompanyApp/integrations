<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Create an EmailOctopus mailing list. */
class EmailOctopusCreateList extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_create_list';
    protected const DESCRIPTION = 'Create an EmailOctopus mailing list.';
    protected const METHOD = 'createList';
    protected const PARAMETERS = ['name' => ['type' => 'string', 'required' => true, 'description' => 'The list name.']];
}
