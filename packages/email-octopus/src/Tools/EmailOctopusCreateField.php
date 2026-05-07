<?php

namespace OpenCompany\Integrations\EmailOctopus\Tools;

/** Create a field on an EmailOctopus list. */
class EmailOctopusCreateField extends AbstractEmailOctopusTool
{
    protected const NAME = 'emailoctopus_create_field';
    protected const DESCRIPTION = 'Create a custom field on an EmailOctopus mailing list.';
    protected const METHOD = 'createField';
    protected const PARAMETERS = ['list_id' => ['type' => 'string', 'description' => 'List ID. Uses the configured default when omitted.'], 'tag' => ['type' => 'string', 'required' => true, 'description' => 'Field tag.'], 'type' => ['type' => 'string', 'required' => true, 'enum' => ['NUMBER', 'TEXT', 'DATE'], 'description' => 'Field type.'], 'label' => ['type' => 'string', 'description' => 'Human-readable label.'], 'fallback' => ['type' => 'string', 'description' => 'Fallback value.']];
}
