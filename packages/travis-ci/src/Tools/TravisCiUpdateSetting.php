<?php

namespace OpenCompany\Integrations\TravisCi\Tools;

/**
 * Update one Travis CI repository setting.
 */
class TravisCiUpdateSetting extends AbstractTravisCiTool
{
    protected const NAME = 'travis_ci_update_setting';
    protected const DESCRIPTION = 'Update one Travis CI repository setting using the official setting payload.';
    protected const METHOD = 'updateSetting';
    protected const REQUIRED = ['repository', 'setting', 'payload'];
    protected const PARAMETERS = ['repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository id or slug.'], 'setting' => ['type' => 'string', 'required' => true, 'description' => 'Setting name.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Setting payload.']];
}
