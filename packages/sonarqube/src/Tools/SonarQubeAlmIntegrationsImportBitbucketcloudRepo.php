<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Create a SonarQube project with the information from the provided Bitbucket Cloud repository. Autoconfigure pull request decoration mechanism. Requires the 'Create Projects' permission.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/alm_integrations/import_bitbucketcloud_repo.
 */
class SonarQubeAlmIntegrationsImportBitbucketcloudRepo extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_alm_integrations_import_bitbucketcloud_repo';
    protected const DESCRIPTION = 'Create a SonarQube project with the information from the provided Bitbucket Cloud repository. Autoconfigure pull request decoration mechanism. Requires the \'Create Projects\' permission

Official SonarQube Web API endpoint: POST /api/alm_integrations/import_bitbucketcloud_repo.

Deprecated since SonarQube 10.5; kept for API parity with servers that still expose it.';
    protected const PARAMETERS = array (
      'alm_setting' => array (
        'type' => 'string',
        'description' => 'DevOps Platform configuration key. This parameter is optional if you have only one BitBucket Cloud integration.',
        'required' => false,
      ),
      'new_code_definition_type' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Type New code definitions of the following types are allowed:- PREVIOUS_VERSION; - NUMBER_OF_DAYS; - REFERENCE_BRANCH - will default to the main branch.;',
        'required' => false,
      ),
      'new_code_definition_value' => array (
        'type' => 'string',
        'description' => 'Project New Code Definition Value For each new code definition type, a different value is expected:- no value, when the new code definition type is PREVIOUS_VERSION and REFERENCE_BRANCH; - a number between 1 and 90, when the new code definition type is NUMBER_OF_DAYS;',
        'required' => false,
      ),
      'repository_slug' => array (
        'type' => 'string',
        'description' => 'Bitbucket Cloud repository slug',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/alm_integrations/import_bitbucketcloud_repo';
    protected const PARAM_MAP = array (
      'almSetting' => 'alm_setting',
      'newCodeDefinitionType' => 'new_code_definition_type',
      'newCodeDefinitionValue' => 'new_code_definition_value',
      'repositorySlug' => 'repository_slug',
    );
}
