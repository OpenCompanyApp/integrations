<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Delete a field from an EmailOctopus list. */
class EmailOctopusDeleteField extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_delete_field';
    protected const DESCRIPTION = 'Delete a custom field from an EmailOctopus mailing list.';
    protected const METHOD = 'deleteField';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'Field tag.']];
}
