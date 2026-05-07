<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Bulk update a project or module key and all its sub-components keys. The bulk update allows to replace a part of the current key by another string on the current project and all its sub-modules. It's possible to simulate the bulk update by setting the parameter 'dryRun' at true. No key is updated with a dry run. Ex: to rename a project with key 'my_project' to 'my_new_project' and all its sub-components keys, call the WS with parameters: - project: my_project; - from: my_; - to: my_new_; Requires the permission 'Administer' on the specified project..
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/projects/bulk_update_key.
 */
class SonarCloudProjectsBulkUpdateKey extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_projects_bulk_update_key';
    protected const DESCRIPTION = 'Bulk update a project or module key and all its sub-components keys. The bulk update allows to replace a part of the current key by another string on the current project and all its sub-modules. It\'s possible to simulate the bulk update by setting the parameter \'dryRun\' at true. No key is updated with a dry run. Ex: to rename a project with key \'my_project\' to \'my_new_project\' and all its sub-components keys, call the WS with parameters: - project: my_project; - from: my_; - to: my_new_; Requires the permission \'Administer\' on the specified project.

Official SonarCloud Web API endpoint: POST /api/projects/bulk_update_key.

Deprecated since SonarCloud 7.6; kept for API parity while the official registry still exposes it.';
    protected const PARAMETERS = array (
      'dry_run' => array (
        'type' => 'string',
        'description' => 'Simulate bulk update. No component key is updated.',
        'required' => false,
        'enum' => array (
          'true',
          'false',
          'yes',
          'no',
        ),
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'String to match in components keys',
        'required' => true,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project or module key',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'String replacement in components keys',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/projects/bulk_update_key';
    protected const PARAM_MAP = array (
      'dryRun' => 'dry_run',
      'from' => 'from',
      'project' => 'project',
      'to' => 'to',
    );
}
